<?php
namespace App\Http\Controllers;

use App\Models\ListingDetail;
use Illuminate\Http\Request;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    public function index()
    {
        $listing = ListingDetail::all();
        return view('admin.listing.index', compact('listing'));
    }

    public function create()
    {
        return view('admin.listing.create');
    }

    public function store(Request $request, ImageUploadService $imageUploadService)
    {
        $property = new ListingDetail();
        $property->breadcrumbs = $request->breadcrumbs;
        $property->page_name = $request->name;
        $property->blog_heading = $request->eighth_heading;
        $property->blog_description = $request->eighth_description;
        $property->blog_button_label = $request->eighth_section_button; // Default to 0 if not provided
        $property->blog_button_url = $request->eighth_section_button_2;
        $property->meta_tags = $request->meta_tags;        

        if ($request->hasFile('blog_background')) {
            $property->blog_background = $imageUploadService->storeImage($request->file('blog_background'), 'blog_background_');
        }
        $property->save();

        return redirect()->route('listing.index')->with('success', 'Listing page created successfully.');
    }

    public function edit(ListingDetail $listing)
    {
        return view('admin.listing.edit', compact('listing'));
    }

    public function update(Request $request, $id, ImageUploadService $imageUploadService)
    {
        $property = ListingDetail::findOrFail($id);
        // Update the fields with data from the request
        $property->breadcrumbs = $request->breadcrumbs;
        $property->blog_heading = $request->eighth_heading;
        $property->blog_description = $request->eighth_description;
        $property->blog_button_label = $request->eighth_section_button; 
        $property->blog_button_url = $request->eighth_section_button_2;
        $property->meta_tags = $request->meta_tags;

        $property->number_client = $request->number_client;
        $property->number_property = $request->number_property;
        
        $property->dtd = $request->dtd;
    
    $property->dbd = $request->dbd;
    

        // Check if a new blog background image is uploaded and store it
        if ($request->hasFile('blog_background')) {
            // Delete the old image if exists
            if ($request->blog_background && Storage::exists($request->blog_background)) {
                Storage::delete($request->blog_background);
            }

            // Store the new image
            $property->blog_background = $imageUploadService->storeImage($request->file('blog_background'), 'blog_background_');
        }
        
        if ($request->hasFile('image_1')) {
            // Delete the old image if exists
            if ($request->image_1 && Storage::exists($request->image_1)) {
                Storage::delete($request->image_1);
            }

            // Store the new image
            $property->image_1 = $imageUploadService->storeImage($request->file('image_1'), 'image_1_');
        }
        if ($request->hasFile('image_2')) {
            // Delete the old image if exists
            if ($request->image_2 && Storage::exists($request->image_2)) {
                Storage::delete($request->image_2);
            }

            // Store the new image
            $property->image_2 = $imageUploadService->storeImage($request->file('image_2'), 'image_2_');
        }
        
        // Save the updated property to the database
        $property->update();

        // Redirect with a success message
        return redirect()->route('listing.index')->with('success', 'Listing page updated successfully.');
    }

    public function destroy($id)
    {
        dd($id);
        $agent->delete();
        return redirect()->route('agents.index')->with('success', 'Agent deleted successfully.');
    }
}
