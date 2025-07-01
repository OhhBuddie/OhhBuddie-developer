<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ImageUploadController extends Controller
{
    public function showForm()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|file|mimes:jpg,jpeg,png,gif,webp',
        ]);

        $file = $request->file('image');
        $originalName = $file->getClientOriginalName(); // e.g., dual logo.png

        // Upload to R2 with original name
        $path = $file->storeAs('images', $originalName, 'r2');

        // Generate R2.dev public URL (note: no bucket name in path)
        $publicUrl = 'https://pub-859cf3e1f0194751917386af714f48e5.r2.dev/' . $path;

        return back()->with([
            'success' => 'Image uploaded successfully!',
            'image_url' => $publicUrl,
            'image_name' => $originalName,
        ]);
    }


}