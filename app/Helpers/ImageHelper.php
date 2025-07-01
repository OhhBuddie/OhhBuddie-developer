<?php
use Intervention\Image\Facades\Image;

function compressImage($path, $maxSize = 200) 
{
    try {
        // Check if file exists
        if (!file_exists($path)) {
            throw new \Exception("File not found: " . $path);
        }
        
        // Check if Intervention Image is available
        if (!class_exists('Intervention\Image\Facades\Image')) {
            throw new \Exception("Intervention Image package not installed");
        }
        
        $img = Image::make($path);
        
        // Get original format
        $originalFormat = pathinfo($path, PATHINFO_EXTENSION);
        
        // Reduce quality progressively until under max size
        $quality = 90;
        $tempImg = clone $img; // Work with a copy
        
        do {
            $tempImg = clone $img; // Reset to original for each iteration
            
            // Encode to WebP or original format
            if (function_exists('imagewebp')) {
                $encoded = $tempImg->encode('webp', $quality);
            } else {
                $encoded = $tempImg->encode($originalFormat, $quality);
            }
            
            $size = strlen($encoded->__toString()) / 1024; // Size in KB
            $quality -= 10;
            
        } while ($size > $maxSize && $quality > 10);
        
        // Return as data URL
        return $encoded->encode('data-url')->encoded;
        
    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error('Image compression failed: ' . $e->getMessage());
        
        // Return original path or a placeholder
        return $path;
    }
}

// Alternative function without Intervention Image (GD Library fallback)
function compressImageGD($path, $maxSize = 200) 
{
    try {
        if (!file_exists($path)) {
            return $path;
        }
        
        // Get image info
        $imageInfo = getimagesize($path);
        if (!$imageInfo) {
            return $path;
        }
        
        $width = $imageInfo[0];
        $height = $imageInfo[1];
        $type = $imageInfo[2];
        
        // Create image resource based on type
        switch ($type) {
            case IMAGETYPE_JPEG:
                $source = imagecreatefromjpeg($path);
                break;
            case IMAGETYPE_PNG:
                $source = imagecreatefrompng($path);
                break;
            case IMAGETYPE_GIF:
                $source = imagecreatefromgif($path);
                break;
            default:
                return $path;
        }
        
        if (!$source) {
            return $path;
        }
        
        // Calculate new dimensions (resize if too large)
        $maxDimension = 1200;
        if ($width > $maxDimension || $height > $maxDimension) {
            $ratio = min($maxDimension / $width, $maxDimension / $height);
            $newWidth = intval($width * $ratio);
            $newHeight = intval($height * $ratio);
            
            $resized = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($resized, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagedestroy($source);
            $source = $resized;
        }
        
        // Compress with different quality levels
        $quality = 90;
        do {
            ob_start();
            imagejpeg($source, null, $quality);
            $imageData = ob_get_contents();
            ob_end_clean();
            
            $size = strlen($imageData) / 1024; // Size in KB
            $quality -= 10;
            
        } while ($size > $maxSize && $quality > 10);
        
        imagedestroy($source);
        
        // Return as data URL
        $base64 = base64_encode($imageData);
        return 'data:image/jpeg;base64,' . $base64;
        
    } catch (\Exception $e) {
        return $path;
    }
}