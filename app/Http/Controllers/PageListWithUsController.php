<?php namespace App\Http\Controllers;

use App\Models\PageListWithUs;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class PageListWithUsController extends Controller
{
    public function index()
    {
        $section = PageListWithUs::latest()->first();
        // return view('sections.index', compact('sections'));
        if($section){
            return view('sections.edit', compact('section'));
        }
        return view('sections.create');
    }

    public function Frontend(){
        $section = PageListWithUs::latest()->first();
        if($section){
            return view('sections.list-with-us', compact('section'));
        }
        return view('list-with-us'); 
    }

    public function create()
    {
        return view('sections.create');
    }

    public function store(Request $request, ImageUploadService $imageUploadService)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'sub_heading' => 'required|string|max:255',
            'anchor_link' => 'nullable|url',
            'section_1_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            // 'section_2_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            // 'section_2_title_1' => 'nullable|string|max:255',
            // 'section_2_subheading_1' => 'nullable|string|max:255',
            // Add validation for other section_2_image, section_2_title, and section_2_subheading...
            'section_3_heading' => 'nullable|string|max:255',
            'section_3_subheading' => 'nullable|string|max:255',
            'section_3_anchor_link' => 'nullable|url',
        ]);

        $section = new PageListWithUs();
        $section->heading = $request->heading;
        $section->sub_heading = $request->sub_heading;
        $section->anchor_link = $request->anchor_link;

        // Handle file uploads for Section 1 image
        $section->section_1_image = $request->hasFile('section_1_image') ? $imageUploadService->storeImage($request->file('section_1_image'), 'images'): null;

        $section->section_2_image_1 = $request->hasFile('section_2_image_1') ? $imageUploadService->storeImage($request->file('section_2_image_1'), 'images'): null;
        $section->section_2_image_2 = $request->hasFile('section_2_image_2') ? $imageUploadService->storeImage($request->file('section_2_image_2'), 'images'): null;
        $section->section_2_image_3 = $request->hasFile('section_2_image_3') ? $imageUploadService->storeImage($request->file('section_2_image_3'), 'images'): null;

        $section->section_1_heading = $request->section_1_heading;
        $section->section_1_description = $request->section_1_description;

        // Handle other Section 2 data (titles and sub-headings)
        $section->section_2_title_1 = $request->section_2_title_1;
        $section->section_2_subheading_1 = $request->section_2_subheading_1;
        $section->section_2_url_1 = $request->section_2_url_1;
        $section->section_2_title_2 = $request->section_2_title_2;
        $section->section_2_subheading_2 = $request->section_2_subheading_2;
        $section->section_2_url_2 = $request->section_2_url_2;
        $section->section_2_title_3 = $request->section_2_title_3;
        $section->section_2_subheading_3 = $request->section_2_subheading_3;
        $section->section_2_url_3 = $request->section_2_url_3;

        // Handle Section 3 data
        $section->section_3_heading = $request->section_3_heading;
        $section->section_3_subheading = $request->section_3_subheading;
        $section->section_3_anchor_link = $request->section_3_anchor_link;

        $section->save();

        return redirect()->route('sections.index');
    }

    public function edit($id)
    {
        $section = PageListWithUs::findOrFail($id);
        return view('sections.edit', compact('section'));
    }

    public function update(Request $request, $id, ImageUploadService $imageUploadService)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'sub_heading' => 'required|string|max:255',
            'anchor_link' => 'nullable|url',
            // Validate other fields...
        ]);

        $section = PageListWithUs::findOrFail($id);
        $section->heading = $request->heading;
        $section->sub_heading = $request->sub_heading;
        $section->anchor_link = $request->anchor_link;

        // Handle file uploads for Section 1 image

        $section->section_1_heading = $request->section_1_heading;
        $section->section_1_description = $request->section_1_description;

        $section->section_1_image = $request->hasFile('section_1_image') ? $imageUploadService->storeImage($request->file('section_1_image'), 'images'): $section->section_1_image;

        $section->section_2_image_1 = $request->hasFile('section_2_image_1') ? $imageUploadService->storeImage($request->file('section_2_image_1'), 'images'): $section->section_2_image_1;
        $section->section_2_image_2 = $request->hasFile('section_2_image_2') ? $imageUploadService->storeImage($request->file('section_2_image_2'), 'images'): $section->section_2_image_2;
        $section->section_2_image_3 = $request->hasFile('section_2_image_3') ? $imageUploadService->storeImage($request->file('section_2_image_3'), 'images'): $section->section_2_image_3;


        // Handle other Section 2 data (titles and sub-headings)
        $section->section_2_title_1 = $request->section_2_title_1;
        $section->section_2_subheading_1 = $request->section_2_subheading_1;
        $section->section_2_url_1 = $request->section_2_url_1;
        $section->section_2_title_2 = $request->section_2_title_2;
        $section->section_2_subheading_2 = $request->section_2_subheading_2;
        $section->section_2_url_2 = $request->section_2_url_2;
        $section->section_2_title_3 = $request->section_2_title_3;
        $section->section_2_subheading_3 = $request->section_2_subheading_3;
        $section->section_2_url_3 = $request->section_2_url_3;

        // Handle Section 3 data
        $section->section_3_heading = $request->section_3_heading;
        $section->section_3_subheading = $request->section_3_subheading;
        $section->section_3_anchor_link = $request->section_3_anchor_link;

        $section->save();

        return redirect()->route('sections.index');
    }

    public function destroy($id)
    {
        $section = PageListWithUs::findOrFail($id);
        $section->delete();

        return redirect()->route('sections.index');
    }
}
