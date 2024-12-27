<?php

namespace App\Http\Controllers;

use App\Models\PageBrandedResidence;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class PageBrandedResidenceController extends Controller
{
    // Display a listing of the sections
    public function index()
    {
        $sections = PageBrandedResidence::latest()->first();
        if($sections){
            return view('PageBrandedResidence.create', compact('sections'));
        }else{
            return view('PageBrandedResidence.create');
        }
    }

    // Show the form for creating a new section
    public function create()
    {
        return view('PageBrandedResidence.create');
    }

    // Store a newly created section in storage
    public function store(Request $request, ImageUploadService $imageUploadService)
    {
        // $request->validate([
        //     'title' => 'nullable|string|max:255',
        //     'description' => 'nullable|string',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     // 'link' => 'nullable|url',
        //     'heading_1' => 'nullable|string|max:255',
        //     'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'description_1' => 'nullable|string',
        //     'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'description_2' => 'nullable|string',
        //     'heading_3' => 'nullable|string',
        //     'images_3' => 'nullable|array',
        //     'headings_3' => 'nullable|array',
        //     'title_4' => 'nullable|string',
        //     'description_4' => 'nullable|string',
        //     'image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     // 'link_4' => 'nullable|url',
        // ]);

        if (isset($request->images_3) && count($request->images_3)) {
            $imagePaths = []; // Initialize an array to store image paths
            
            foreach ($request->images_3 as $key=>$item) {
                // Check if the item is an instance of UploadedFile before storing it
                if ($item instanceof \Illuminate\Http\UploadedFile) {
                    // Store the image and get the file path
                    $timestamp = now()->timestamp;
                    $extension = $item->getClientOriginalExtension();
                    $newFileName = 'image_' . $timestamp . $key . '.' . $extension;
                    // Move the image to the public path
                    $item->move('images', $newFileName);
                    $imagePaths[] = 'images' . '/' . $newFileName;         
                }
            }
        }
        $data = PageBrandedResidence::latest()->first();
        $image_old = $image_1_old =  $image_2_old = $image_4_old = "";
        if($data){
            if(empty($imagePaths) || !$imagePaths){
                if($data->images_3){
                    $imagePaths = $data->images_3;
                    
                }
            }
            if(!$request->hasFile('image')){
                $image_old = $data->image;
            }
            if(!$request->hasFile('image_1')){
                $image_1_old = $data->image_1;
            }
            if(!$request->hasFile('image_2')){
                $image_2_old = $data->image_2;
            }
            if(!$request->hasFile('image_4')){
                $image_4_old = $data->image_4;
            }   
        }


        $image = $request->hasFile('image') ? $imageUploadService->storeImage($request->file('image'), 'images',90): $image_old;
        $image_1 = $request->hasFile('image_1') ? $imageUploadService->storeImage($request->file('image_1'),'images',91): $image_1_old;
        $image_2 = $request->hasFile('image_2') ? $imageUploadService->storeImage($request->file('image_2'),'images',92): $image_2_old;
        $image_4 = $request->hasFile('image_4') ? $imageUploadService->storeImage($request->file('image_4'), 'images',93): $image_4_old;




        $property = new PageBrandedResidence();
        $property->page_title = $request->page_title; 
        $property->title = $request->title;
        $property->description = $request->description;
        $property->image = $image;
        $property->link = $request->link;
        $property->heading_1 = $request->heading_1;
        $property->image_1 = $image_1;
        $property->description_1 = $request->description_1;
        $property->image_2 = $image_2;
        $property->description_2 = $request->description_2;
        $property->heading_3 = $request->heading_3;
        $property->images_3 = $imagePaths ?? "";
        $property->headings_3 = $request->headings_3;
        $property->title_4 = $request->title_4;
        $property->description_4 = $request->description_4;
        $property->image_4 = $image_4;
        $property->link_4 = $request->link_4;

        $property->tripal_win_title_1 = $request->tripal_win_title_1;
        $property->tripal_win_title_2 = $request->tripal_win_title_2;
        $property->tripal_win_title_3 = $request->tripal_win_title_3;
        
        $property->tripal_win_image_1 = $request->hasFile('tripal_win_image_1') ? $imageUploadService->storeImage($request->file('tripal_win_image_1'), 'images',95): $data->tripal_win_image_1;
        $property->tripal_win_image_2 = $request->hasFile('tripal_win_image_2') ? $imageUploadService->storeImage($request->file('tripal_win_image_2'), 'images',96): $data->tripal_win_image_2;
        $property->tripal_win_image_3 = $request->hasFile('tripal_win_image_3') ? $imageUploadService->storeImage($request->file('tripal_win_image_3'), 'images',97): $data->tripal_win_image_3;

        // Save the model
        $property->save();


        return redirect()->route('page_branded_residence.index')->with('success', 'Section created successfully!');
    }

    // Display the specified section
    public function show(PageBrandedResidence $section)
    {
        return view('sections.show', compact('section'));
    }

    // Show the form for editing the specified section
    public function edit(PageBrandedResidence $section)
    {
        return view('sections.edit', compact('section'));
    }

    // Update the specified section in storage
    public function update(Request $request, PageBrandedResidence $section)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'heading_1' => 'nullable|string|max:255',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description_1' => 'nullable|string',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description_2' => 'nullable|string',
            'heading_3' => 'nullable|string',
            'images_3' => 'nullable|array',
            'headings_3' => 'nullable|array',
            'title_4' => 'nullable|string',
            'description_4' => 'nullable|string',
            'image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link_4' => 'nullable|url',
        ]);

        // Handle file uploads
        if ($request->hasFile('image')) {
            $request->merge(['image' => $request->file('image')->store('images', 'public')]);
        }
        if ($request->hasFile('image_1')) {
            $request->merge(['image_1' => $request->file('image_1')->store('images', 'public')]);
        }
        if ($request->hasFile('image_2')) {
            $request->merge(['image_2' => $request->file('image_2')->store('images', 'public')]);
        }
        if ($request->hasFile('image_4')) {
            $request->merge(['image_4' => $request->file('image_4')->store('images', 'public')]);
        }

        // Update the section with new data
        $section->update($request->all());

        return redirect()->route('sections.index')->with('success', 'Section updated successfully!');
    }

    // Remove the specified section from storage
    public function destroy(PageBrandedResidence $section)
    {
        $section->delete();
        return redirect()->route('sections.index')->with('success', 'Section deleted successfully!');
    }
}
