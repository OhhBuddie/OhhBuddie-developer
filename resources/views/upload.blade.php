<!DOCTYPE html>
<html>
<head>
    <title>Upload to R2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #4cc9f0;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
            color: #343a40;
            line-height: 1.6;
        }
        
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-color);
            font-weight: 700;
            padding-bottom: 10px;
            border-bottom: 3px solid var(--primary-color);
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .alert-success {
            background-color: #d4edda;
            border-left: 5px solid #38b000;
            color: #155724;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            border-left: 5px solid #d00000;
            color: #721c24;
        }
        
        .container {
            background-color: white;
            padding: 30px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #495057;
        }
        
        input[type="file"] {
            width: 100%;
            padding: 10px;
            background-color: #e9ecef;
            border: 2px dashed var(--primary-color);
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
        }
        
        input[type="file"]:hover {
            background-color: #e2e6ea;
        }
        
        .file-upload-wrapper {
            position: relative;
            padding: 20px;
            text-align: center;
            background-color: #f1f3f5;
            border-radius: var(--border-radius);
            border: 2px dashed var(--primary-color);
            transition: var(--transition);
        }
        
        .file-upload-wrapper:hover {
            background-color: #e9ecef;
        }
        
        .file-upload-label {
            display: block;
            margin-bottom: 10px;
            font-weight: normal;
            color: #6c757d;
        }
        
        .btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: var(--border-radius);
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: var(--transition);
            width: 100%;
            text-transform: uppercase;
            box-shadow: 0 4px 6px rgba(67, 97, 238, 0.3);
        }
        
        .btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(67, 97, 238, 0.4);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .image-preview {
            margin-top: 30px;
            padding: 20px;
            border-radius: var(--border-radius);
            background-color: white;
            box-shadow: var(--box-shadow);
            text-align: center;
            animation: fadeIn 0.5s ease;
        }
        
        .image-preview h3 {
            margin-bottom: 15px;
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .image-preview img {
            max-width: 100%;
            height: auto;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 15px;
            transition: var(--transition);
        }
        
        .image-preview img:hover {
            transform: scale(1.02);
        }
        
        .url-container {
            background-color: #f1f3f5;
            padding: 15px;
            border-radius: var(--border-radius);
            margin-top: 15px;
            word-break: break-all;
        }
        
        .url-container a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .url-container a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }
        
        .header-icon {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .header-icon svg {
            width: 60px;
            height: 60px;
            color: var(--primary-color);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }
            
            .container {
                padding: 20px;
            }
            
            h1 {
                font-size: 24px;
            }
            
            .btn {
                padding: 10px 15px;
            }
        }
        
        @media (max-width: 480px) {
            body {
                padding: 10px;
            }
            
            .container {
                padding: 15px;
            }
            
            h1 {
                font-size: 20px;
                margin-bottom: 20px;
            }
            
            .form-group {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="17 8 12 3 7 8"></polyline>
                <line x1="12" y1="3" x2="12" y2="15"></line>
            </svg>
        </div>
        
        <h1>Upload Image to Cloudflare R2</h1>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="file-upload-wrapper">
                    <label for="image" class="file-upload-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 8px;">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                        <br>
                        Choose Image (Max 2MB)
                    </label>
                    <input type="file" name="image" id="image" accept="image/*" required>
                </div>
            </div>
            <button type="submit" class="btn">Upload to R2</button>
        </form>

        @if(session('image_url'))
            <div class="image-preview">
                <h3>Uploaded Successfully!</h3>
                <img src="{{ session('image_url') }}" alt="Uploaded Image" width="300">
                <div class="url-container">
                    <p>Direct URL: <a href="{{ session('image_url') }}" target="_blank">{{ session('image_url') }}</a></p>
                </div>
            </div>
        @endif
    </div>
</body>
</html>