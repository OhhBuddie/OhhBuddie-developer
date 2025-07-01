<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use DateTime;
use DateTimeZone;

class R2UploadController extends Controller
{
    public function form()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $file = $request->file('image');
        $filename = 'images/' . Str::random(20) . '.' . $file->getClientOriginalExtension();
        $contentType = $file->getMimeType();
        $fileContent = file_get_contents($file->getPathname());

        try {
            // Try primary upload method
            $url = $this->uploadToR2Direct(
                'fileuploadbucket',
                $filename,
                $fileContent,
                $contentType,
                'your-access-key',
                'your-secret-key'
            );

            Log::info('R2 upload successful', ['url' => $url]);
            
            return back()->with([
                'success' => 'Uploaded to Cloudflare R2 successfully!',
                'url' => $url
            ]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('R2 upload failed with primary method', ['error' => $e->getMessage()]);
            
            try {
                // Try fallback method
                $url = $this->uploadToR2WithCurl(
                    'fileuploadbucket',
                    $filename,
                    $fileContent,
                    $contentType,
                    'your-access-key',
                    'your-secret-key'
                );
                
                Log::info('R2 upload successful with fallback method', ['url' => $url]);
                
                return back()->with([
                    'success' => 'Uploaded to Cloudflare R2 successfully (fallback method)!',
                    'url' => $url
                ]);
            } catch (\Exception $fallbackE) {
                Log::error('R2 upload failed with fallback method', ['error' => $fallbackE->getMessage()]);
                return back()->withErrors([
                    'upload_error' => 'Upload failed: ' . $fallbackE->getMessage()
                ]);
            }
        }
    }

    /**
     * Upload directly to R2 using Guzzle HTTP client with improved TLS configuration
     */
    private function uploadToR2Direct($bucket, $key, $content, $contentType, $accessKey, $secretKey)
    {
        $date = new DateTime('now', new DateTimeZone('UTC'));
        $amzDate = $date->format('Ymd\THis\Z');
        $dateStamp = $date->format('Ymd');
        
        $r2AccountId = 'e7d6c0d57c6b79c624df0651746167ee3f89b';
        $endpoint = "https://{$r2AccountId}.r2.cloudflarestorage.com";
        $uri = "/{$bucket}/{$key}";
        $fullUrl = "{$endpoint}{$uri}";
        
        // Set up basic request parameters
        $method = 'PUT';
        $service = 's3';
        $region = 'auto';
        $algorithm = 'AWS4-HMAC-SHA256';
        $contentSha256 = hash('sha256', $content);
        
        // Create canonical request
        $canonicalHeaders = "content-type:{$contentType}\n" .
                            "host:{$r2AccountId}.r2.cloudflarestorage.com\n" .
                            "x-amz-content-sha256:{$contentSha256}\n" .
                            "x-amz-date:{$amzDate}\n";
                            
        $signedHeaders = 'content-type;host;x-amz-content-sha256;x-amz-date';
        
        $canonicalRequest = "{$method}\n" .
                           "{$uri}\n" .
                           "\n" . // Query parameters (empty)
                           $canonicalHeaders . "\n" .
                           $signedHeaders . "\n" .
                           $contentSha256;
        
        // Create string to sign
        $scope = "{$dateStamp}/{$region}/{$service}/aws4_request";
        $stringToSign = "{$algorithm}\n" .
                       "{$amzDate}\n" .
                       "{$scope}\n" .
                       hash('sha256', $canonicalRequest);
        
        // Calculate signature
        $signingKey = $this->getSignatureKey($secretKey, $dateStamp, $region, $service);
        $signature = hash_hmac('sha256', $stringToSign, $signingKey);
        
        // Create authorization header
        $authorization = "{$algorithm} " .
                        "Credential={$accessKey}/{$scope}, " .
                        "SignedHeaders={$signedHeaders}, " .
                        "Signature={$signature}";
        
        // Create a Guzzle client with revised TLS settings for better compatibility
        $client = new Client([
            'verify' => true,
            'curl' => [
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_SSL_VERIFYHOST => 2,
                // Use TLS 1.2 only (more compatible approach)
                CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
                // Disable potentially problematic options
                CURLOPT_SSL_ENABLE_ALPN => false,
                CURLOPT_SSL_ENABLE_NPN => false,
                // Let server negotiate HTTP version
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_NONE,
                // Enable verbose for debugging if needed
                CURLOPT_VERBOSE => false
            ],
            'timeout' => 30,
            'connect_timeout' => 10,
        ]);
        
        // Create a stream for verbose output if needed
        $verbose = null;
        if (defined('CURLOPT_VERBOSE') && CURLOPT_VERBOSE) {
            $verbose = fopen('php://temp', 'w+');
            $client = new Client([
                'curl' => [
                    CURLOPT_STDERR => $verbose
                ]
            ]);
        }
        
        try {
            $response = $client->request('PUT', $fullUrl, [
                'headers' => [
                    'Authorization' => $authorization,
                    'Content-Type' => $contentType,
                    'x-amz-content-sha256' => $contentSha256,
                    'x-amz-date' => $amzDate,
                    'x-amz-acl' => 'public-read',
                ],
                'body' => $content,
                'debug' => false,
            ]);
            
            // Return public URL for the object
            return "https://{$bucket}.{$r2AccountId}.r2.cloudflarestorage.com/{$key}";
        } catch (GuzzleException $e) {
            $errorDetails = [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'request' => [
                    'uri' => $fullUrl,
                    'method' => $method,
                    'content_type' => $contentType,
                ],
            ];
            
            // Get verbose curl output for debugging if available
            if ($verbose) {
                rewind($verbose);
                $errorDetails['verbose_log'] = stream_get_contents($verbose);
                fclose($verbose);
            }
            
            // Only try to get response details if it's the right exception type
            if (method_exists($e, 'getResponse') && $e->getResponse()) {
                $errorDetails['response'] = [
                    'status' => $e->getResponse()->getStatusCode(),
                    'body' => (string) $e->getResponse()->getBody(),
                ];
            } else {
                $errorDetails['response'] = 'No response available';
            }
            
            Log::error('Guzzle exception', $errorDetails);
            throw $e;
        }
    }

    /**
     * Fallback method using native cURL instead of Guzzle
     */
    private function uploadToR2WithCurl($bucket, $key, $content, $contentType, $accessKey, $secretKey)
    {
        $date = new DateTime('now', new DateTimeZone('UTC'));
        $amzDate = $date->format('Ymd\THis\Z');
        $dateStamp = $date->format('Ymd');
        
        $r2AccountId = 'e7d6c0d57c6b79c624df0651746167ee3f89b';
        $endpoint = "https://{$r2AccountId}.r2.cloudflarestorage.com";
        $uri = "/{$bucket}/{$key}";
        $fullUrl = "{$endpoint}{$uri}";
        
        // Set up basic request parameters
        $method = 'PUT';
        $service = 's3';
        $region = 'auto';
        $algorithm = 'AWS4-HMAC-SHA256';
        $contentSha256 = hash('sha256', $content);
        
        // Create canonical request
        $canonicalHeaders = "content-type:{$contentType}\n" .
                            "host:{$r2AccountId}.r2.cloudflarestorage.com\n" .
                            "x-amz-content-sha256:{$contentSha256}\n" .
                            "x-amz-date:{$amzDate}\n";
                            
        $signedHeaders = 'content-type;host;x-amz-content-sha256;x-amz-date';
        
        $canonicalRequest = "{$method}\n" .
                           "{$uri}\n" .
                           "\n" . // Query parameters (empty)
                           $canonicalHeaders . "\n" .
                           $signedHeaders . "\n" .
                           $contentSha256;
        
        // Create string to sign
        $scope = "{$dateStamp}/{$region}/{$service}/aws4_request";
        $stringToSign = "{$algorithm}\n" .
                       "{$amzDate}\n" .
                       "{$scope}\n" .
                       hash('sha256', $canonicalRequest);
        
        // Calculate signature
        $signingKey = $this->getSignatureKey($secretKey, $dateStamp, $region, $service);
        $signature = hash_hmac('sha256', $stringToSign, $signingKey);
        
        // Create authorization header
        $authorization = "{$algorithm} " .
                        "Credential={$accessKey}/{$scope}, " .
                        "SignedHeaders={$signedHeaders}, " .
                        "Signature={$signature}";
        
        // Initialize cURL session
        $ch = curl_init($fullUrl);
        
        // Set method to PUT
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        
        // Set headers
        $headers = [
            'Authorization: ' . $authorization,
            'Content-Type: ' . $contentType,
            'x-amz-content-sha256: ' . $contentSha256,
            'x-amz-date: ' . $amzDate,
            'x-amz-acl: public-read',
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        // Set the request body
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        
        // Return the response instead of outputting it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Enable verbose output for debugging
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        $verbose = fopen('php://temp', 'w+');
        curl_setopt($ch, CURLOPT_STDERR, $verbose);
        
        // TLS 1.2 settings (use only TLS 1.2)
        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        
        // Execute the request
        $response = curl_exec($ch);
        
        // Check for errors
        if (curl_errno($ch)) {
            rewind($verbose);
            $verboseLog = stream_get_contents($verbose);
            
            $error = 'cURL error (' . curl_errno($ch) . '): ' . curl_error($ch) . "\n" . 
                     'Verbose log: ' . $verboseLog;
            
            curl_close($ch);
            fclose($verbose);
            
            // Try one more time with less secure settings only if TLS handshake failed
            if (curl_errno($ch) == 35) { // CURLE_SSL_CONNECT_ERROR
                Log::warning('Falling back to less secure TLS settings');
                return $this->uploadToR2WithLowerSecurityCurl($bucket, $key, $content, $contentType, $accessKey, $secretKey);
            }
            
            // Log and throw the error
            Log::error('cURL error', ['error' => $error]);
            throw new \Exception('cURL error: ' . curl_error($ch));
        }
        
        // Close the cURL session
        curl_close($ch);
        fclose($verbose);
        
        // Return public URL for the object
        return "https://{$bucket}.{$r2AccountId}.r2.cloudflarestorage.com/{$key}";
    }

    /**
     * Last resort method using less secure TLS settings
     * Only used if standard methods fail
     */
    private function uploadToR2WithLowerSecurityCurl($bucket, $key, $content, $contentType, $accessKey, $secretKey)
    {
        $date = new DateTime('now', new DateTimeZone('UTC'));
        $amzDate = $date->format('Ymd\THis\Z');
        $dateStamp = $date->format('Ymd');
        
        $r2AccountId = 'e7d6c0d57c6b79c624df0651746167ee3f89b';
        $endpoint = "https://738dd275fcde8a38d9d4b710bfba5307.r2.cloudflarestorage.com";
        $uri = "/{$bucket}/{$key}";
        $fullUrl = "{$endpoint}{$uri}";
        
        // Set up basic request parameters
        $method = 'PUT';
        $service = 's3';
        $region = 'auto';
        $algorithm = 'AWS4-HMAC-SHA256';
        $contentSha256 = hash('sha256', $content);
        
        // Create canonical request
        $canonicalHeaders = "content-type:{$contentType}\n" .
                            "host:{$r2AccountId}.r2.cloudflarestorage.com\n" .
                            "x-amz-content-sha256:{$contentSha256}\n" .
                            "x-amz-date:{$amzDate}\n";
                            
        $signedHeaders = 'content-type;host;x-amz-content-sha256;x-amz-date';
        
        $canonicalRequest = "{$method}\n" .
                           "{$uri}\n" .
                           "\n" . // Query parameters (empty)
                           $canonicalHeaders . "\n" .
                           $signedHeaders . "\n" .
                           $contentSha256;
        
        // Create string to sign
        $scope = "{$dateStamp}/{$region}/{$service}/aws4_request";
        $stringToSign = "{$algorithm}\n" .
                       "{$amzDate}\n" .
                       "{$scope}\n" .
                       hash('sha256', $canonicalRequest);
        
        // Calculate signature
        $signingKey = $this->getSignatureKey($secretKey, $dateStamp, $region, $service);
        $signature = hash_hmac('sha256', $stringToSign, $signingKey);
        
        // Create authorization header
        $authorization = "{$algorithm} " .
                        "Credential={$accessKey}/{$scope}, " .
                        "SignedHeaders={$signedHeaders}, " .
                        "Signature={$signature}";
        
        // Initialize cURL session
        $ch = curl_init($fullUrl);
        
        // Set method to PUT
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        
        // Set headers
        $headers = [
            'Authorization: ' . $authorization,
            'Content-Type: ' . $contentType,
            'x-amz-content-sha256: ' . $contentSha256,
            'x-amz-date: ' . $amzDate,
            'x-amz-acl: public-read',
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        // Set the request body
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        
        // Return the response instead of outputting it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Enable verbose output for debugging
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        $verbose = fopen('php://temp', 'w+');
        curl_setopt($ch, CURLOPT_STDERR, $verbose);
        
        // Less secure TLS settings (for compatibility only)
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // WARNING: Reduced security
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);     // WARNING: Reduced security
        
        // Try TLS 1.1 (older but might work with older servers)
        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_1);
        
        // Execute the request
        $response = curl_exec($ch);
        
        // Check for errors
        if (curl_errno($ch)) {
            rewind($verbose);
            $verboseLog = stream_get_contents($verbose);
            
            $error = 'Final attempt failed: cURL error (' . curl_errno($ch) . '): ' . curl_error($ch) . "\n" . 
                     'Verbose log: ' . $verboseLog;
            
            curl_close($ch);
            fclose($verbose);
            
            // Log and give up
            Log::error('Final fallback failed', ['error' => $error]);
            throw new \Exception('Could not upload to R2: ' . curl_error($ch));
        }
        
        // Close the cURL session
        curl_close($ch);
        fclose($verbose);
        
        // Return public URL for the object
        return "https://{$bucket}.{$r2AccountId}.r2.cloudflarestorage.com/{$key}";
    }
    
    /**
     * Generate AWS Signature Version 4 signing key
     */
    private function getSignatureKey($key, $dateStamp, $regionName, $serviceName)
    {
        $kDate = hash_hmac('sha256', $dateStamp, 'AWS4' . $key, true);
        $kRegion = hash_hmac('sha256', $regionName, $kDate, true);
        $kService = hash_hmac('sha256', $serviceName, $kRegion, true);
        $kSigning = hash_hmac('sha256', 'aws4_request', $kService, true);
        return $kSigning;
    }
}