<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Services\ImageUploadService;

class RegionController extends Controller
{
    // Show all regions
    public function index()
    {
        $regions = Region::all();
        return view('regions.index', compact('regions'));
    }

    // Show the form to create a new region
    public function create()
    {
        return view('regions.create');
    }

    // Store a newly created region
    public function store(Request $request, ImageUploadService $imageUploadService)
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|image',
        ]);

        Region::create([
            'name' => $validated['image_url'],
            'description' => $validated['description'],
            'image_url' => $request->hasFile('image_url') ? $imageUploadService->storeImage($request->file('image_url'), 'images'): null,
        ]);

        return redirect()->route('regions.index')->with('success', 'Region created successfully!');
    }

    // Show a specific region
    public function show($id)
    {
        $region = Region::findOrFail($id);
        return view('regions.show', compact('region'));
    }

    // Show the form to edit a region
    public function edit($id)
    {
        $region = Region::findOrFail($id);
        return view('regions.edit', compact('region'));
    }

    // Update the specified region
    public function update(Request $request, $id,ImageUploadService $imageUploadService)
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|image',
        ]);

        $region = Region::findOrFail($id);
        $region->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'image_url' => $request->hasFile('image_url') ? $imageUploadService->storeImage($request->file('image_url'), 'images'): $region->image_url,
        ]);
        
        return redirect()->route('regions.index')->with('success', 'Region updated successfully!');
    }

    // Delete the specified region
    public function destroy($id)
    {
        $region = Region::findOrFail($id);
        $region->delete();

        return redirect()->route('regions.index')->with('success', 'Region deleted successfully!');
    }
}
