<?php

namespace App\Http\Controllers;

use App\Models\community_detail;
use Illuminate\Http\Request;
use App\Services\ImageUploadService;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $community_detail = community_detail::orderBy('id', 'desc')->first();
        return view('admin.communities.create')->with('community_detail',$community_detail);        
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ImageUploadService $imageUploadService)
    {
        $request->validate([
            'tenth_heading' => 'required|string|max:255',
            'tenth_description' => 'required|string|max:255',
            'heading' => 'required|string|max:255',
        ]);

        // Check for matching counts of images and descriptions
        if (count($request->bg_images) !== count($request->Description)) {
            return redirect()->back()->with('error', 'Mismatch in count of background images and descriptions.');
        }

        $header_image = $imageUploadService->storeImage($request->file('bg_image'), 'community', 1);
        $urls = $this->uploadImages($request->bg_images);

        // Construct the JSON array
        $custom_JSON = collect($request->bg_images)->map(function ($image, $key) use ($urls, $request) {
            return [
                'image_url' => $urls[$key],
                'description' => $request->Description[$key] ?? '',
                'button_1' => $request->first_section_button[$key] ?? '',
                'button_2' => $request->button_2[$key] ?? '',
                'url_1' => $request->first_button_url[$key] ?? '',
                'url_2' => $request->url_2[$key] ?? ''
            ];
        })->toArray();

        $tenth_section_image = $imageUploadService->storeImage($request->file('tenth_section_image'), 'community', 1);

        $second_json = [
            "tenth_heading" => $request->tenth_heading,
            "tenth_description" => $request->tenth_description,
            "tenth_section_button" => $request->tenth_section_button ?? '',
            "tenth_section_button_2" => $request->tenth_section_button_2 ?? '',
            "image" => $tenth_section_image ?? ''
        ];

        // Create community detail and save
        community_detail::create([
            'heading' => $request->heading,
            'bg_image' => $header_image,
            'second_section' => json_encode($custom_JSON),
            'insights' => json_encode($second_json),
        ]);

        return redirect()->back()->with('success', 'Community added successfully.');
    }

    private function uploadImages($bg_images)
    {
        return collect($bg_images)->map(function ($image, $key) {
            // Generate a new filename
            $timestamp = now()->timestamp;
            $extension = $image->getClientOriginalExtension();
            $newFileName = "image_{$timestamp}_{$key}.{$extension}";

            // Move the file and return the URL
            $image->move(public_path('images'), $newFileName);
            return 'images/' . $newFileName;
        })->toArray();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
