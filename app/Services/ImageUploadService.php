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
        $file->move($path, $newFileName);

        return $path . '/' . $newFileName; // Return the relative path
    }
    
    public function storeImage_old(UploadedFile $file, string $path, int $key = 0): string
    {
        try {
            // Check if the file is valid
            if (!$file->isValid()) {
                print 'File Error: ' . $file->getError();  // This will give more details about why it's invalid
                die();
            }
        
            $timestamp = now()->timestamp;
            $extension = $file->getClientOriginalExtension();
            $newFileName = 'image_' . $timestamp . $key . '.' . $extension;
        
            // Specify the directory where you want to store the uploaded file

        
            if (!is_dir($path)) {
                throw new \Exception('Upload path does not exist.');
            }
        
            // Move the image to the public path
            $file->move($path, $newFileName);
        
            return $path . '/' . $newFileName;  // Return the relative path
        } catch (\Exception $e) {
            // Print the error message and stop execution
            print 'Error: ' . $e->getMessage();
            die();  // Stop the script execution
        }

    }
}
