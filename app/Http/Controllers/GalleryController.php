<?php 

// app/Http/Controllers/GalleryController.php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all();
        return view('gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function store(Request $request, ImageUploadService $imageUploadService)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'alt' => 'required|string|max:255',
        ]);

        
        if(!empty($request->file('image'))){
            $imageName = $imageUploadService->storeImage($request->file('image'), 'images');
        }

        Gallery::create([
            'image' => $imageName,
            'alt' => $request->alt,
        ]);

        return redirect()->route('gallery.index')->with('success', 'Image added to gallery!');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        if (file_exists($gallery->image)) {
            unlink($gallery->image); // This deletes the file from the server
        }

        $gallery->delete();

        return redirect()->route('gallery.index')->with('success', 'Image deleted from gallery!');
    }
}
