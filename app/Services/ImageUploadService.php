<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    /**
     * Store an uploaded image and return its path.
     *
     * @param UploadedFile $file
     * @param string $path
     * @param string $prefix
     * @return string
     */
    public function storeImage(UploadedFile $file, string $path, int $key = 0): string
    {
        $timestamp = now()->timestamp;
        $extension = $file->getClientOriginalExtension();
        $newFileName = 'image_' . $timestamp . $key . '.' . $extension;
        // Move the image to the public path
        $file->move(public_path($path), $newFileName);

        return $path . '/' . $newFileName; // Return the relative path
    }
}
