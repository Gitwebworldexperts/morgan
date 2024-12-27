<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\CareerPage;
use App\Services\ImageUploadService;
use App\Models\CareerImage;

class CareerPageController extends Controller
{
    // Display the form to edit Career Page
    public function edit()
    {
        $careerPage = CareerPage::with('images')->first(); // Fetch the first CareerPage record
        $images = $careerPage ? $careerPage->images : []; // Get related images, if available
        return view('career.edit', compact('careerPage', 'images'));
    }

    // Handle form submission to update Career Page
    public function update(Request $request, ImageUploadService $imageUploadService)
    {
        $validated = $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
            // 'button_link' => 'nullable|url',
            'section2_heading' => 'nullable|string|max:255',
            'video' => 'nullable|mimes:mp4,mov,avi|max:10240',
            'images.*' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:5120',
        ]);

        // Retrieve or create the CareerPage entry
        $careerPage = CareerPage::firstOrCreate([]);

        // Update basic fields
        $careerPage->update([
            'heading' => $validated['heading'],
            'description' => $validated['description'],
            'button_link' => $validated['button_link'] ?? null,
            'section2_heading' => $validated['section2_heading'] ?? null,
        ]);

        // Handle video upload
        if ($request->hasFile('video')) {
            if ($careerPage->video_path) {
                Storage::delete("/{$careerPage->video_path}");
            }

            $timestamp = now()->timestamp;

            $extension = $request->file('video')->getClientOriginalExtension();
            $newFileName = 'image_' . $timestamp . '1' . '.' . $extension;
            // Move the image to the public path
            $path = $request->file('video')->move('uploads/video', $newFileName);

            
            $careerPage->video_path = $path;
            $careerPage->save();
        }

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $timestamp = now()->timestamp;

                $extension = $image->getClientOriginalExtension();
                $newFileName = 'image_' . $timestamp . $key . '.' . $extension;
                // Move the image to the public path
                $path = $image->move('uploads/images', $newFileName);
                
                CareerImage::create([
                    'career_page_id' => $careerPage->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('career.edit')->with('success', 'Career Page updated successfully!');
    }

    // Handle deletion of a single image
    public function deleteImage(Request $request)
    {
        // dd($request->input('id'));
        $image = CareerImage::findOrFail($request->input('id'));
        Storage::delete("{$image->image_path}");
        $image->delete();
    
        return response()->json(['success' => true]);
    }
}
