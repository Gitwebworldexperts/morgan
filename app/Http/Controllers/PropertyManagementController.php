<?php

namespace App\Http\Controllers;

use App\Models\PropertyManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageUploadService;
use App\Models\PropertyQuote;

class PropertyManagementController extends Controller
{
    public function index()
    {
        $pages = PropertyManagement::all();
        return view('PM.index', compact('pages'));
    }

    public function create()
    {
        $pm = PropertyManagement::latest()->first();
        return view('PM.create', compact('pm'));
    }

    public function store(Request $request,ImageUploadService $imageUploadService)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'section_1_title' => 'required|string|max:255',
            'section_1_description' => 'required|string',
            // 'section_1_anchor_link' => 'required|url',
            'section_1_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'section_2_title' => 'required|string|max:255',
            'section_2_description' => 'required|string',
            // 'section_2_anchor_link' => 'required|url',
        ]);
        $section_2_anchor_link = $section_1_image = "";
        $pm = PropertyManagement::latest()->first();
        if(isset($pm->section_1_image) && !empty($pm->section_1_image)){
            $section_1_image = $pm->section_1_image;
        }
        if(isset($pm->get_an_quote_image) && !empty($pm->get_an_quote_image)){
            $get_an_quote_image = $pm->get_an_quote_image;
        }

        if(isset($pm->section_2_anchor_link) && !empty($pm->section_2_anchor_link)){
            $section_2_anchor_link = $pm->section_2_anchor_link;
        }

        // Create the page record
        PropertyManagement::create([
            'title' => $request->title,
            'section_1_title' => $request->section_1_title,
            'section_1_description' => $request->section_1_description,
            'section_1_anchor_link' => $request->section_1_anchor_link,
            'section_1_image' => $request->hasFile('section_1_image') ? $imageUploadService->storeImage($request->file('section_1_image'), 'images'): $section_1_image,
            'get_an_quote_image' => $request->hasFile('get_an_quote_image') ? $imageUploadService->storeImage($request->file('get_an_quote_image'), 'images'): $get_an_quote_image,
            'section_2_title' => $request->section_2_title,
            'section_2_description' => $request->section_2_description,
            // 'section_2_anchor_link' => $request->section_2_anchor_link,
            'section_2_anchor_link' => $request->hasFile('section_2_anchor_link') ? $imageUploadService->storeImage($request->file('section_2_anchor_link'), 'images'): $section_2_anchor_link,            
        ]);

        return redirect()->route('property_management.create')->with('success', 'Page created successfully!');
    }

    public function edit($id)
    {
        $page = PropertyManagement::findOrFail($id);
        return view('PM.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = PropertyManagement::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'section_1_title' => 'required|string|max:255',
            'section_1_description' => 'required|string',
            'section_1_anchor_link' => 'required|url',
            'section_1_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'section_2_title' => 'required|string|max:255',
            'section_2_description' => 'required|string',
            'section_2_anchor_link' => 'required|url',
        ]);

        // Handle file upload for Section 1 Image
        if ($request->hasFile('section_1_image')) {
            // Delete the old image if exists
            if ($page->section_1_image) {
                Storage::delete($page->section_1_image);
            }

            $imagePath = $request->file('section_1_image')->store('public/images');
        } else {
            $imagePath = $page->section_1_image;
        }

        // Update the page record
        $page->update([
            'title' => $request->title,
            'section_1_title' => $request->section_1_title,
            'section_1_description' => $request->section_1_description,
            'section_1_anchor_link' => $request->section_1_anchor_link,
            'section_1_image' => $imagePath,
            'section_2_title' => $request->section_2_title,
            'section_2_description' => $request->section_2_description,
            'section_2_anchor_link' => $request->section_2_anchor_link,
        ]);
        
        return redirect()->route('PM.index')->with('success', 'Page updated successfully!');
    }

    public function quoteStore(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'property_location' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        // Save the data to the database
        PropertyQuote::create($request->all());

        // Redirect or respond with a success message
        return back()->with('success', 'Details submitted successfully!');
    }

    public function quoteData(){
        $contact = PropertyQuote::orderBy('id', 'desc')->paginate(10);
        return view('admin.property_quote_data', compact('contact')); 
    }
}
