<?php
namespace App\Http\Controllers;
use App\Models\ReportIndividual;
use App\Models\Testimonial;
use App\Services\ImageUploadService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ReportIndividualController extends Controller
{
    public function index()
    {
        $reports = ReportIndividual::all();
        return view('reportindividual.index', compact('reports'));
    }

    public function create()
    {
        $testimonials = Testimonial::all();
        return view('reportindividual.create',compact('testimonials'));
    }

    public function show($slug)
    {
        $report = ReportIndividual::where('slug',$slug)->first();
        if($report){
            $testimonials = Testimonial::whereIn('id', json_decode($report->testimonial_description, true))->get();
            return view('indireport', compact('report','testimonials'));
        }
        return redirect()->route('report.list')->with('success', 'Report Not Found!');
    }

    public function store(Request $request, ImageUploadService $imageUploadService)
    {
        $validatedData = $request->validate([
            'heading' => 'required|string',
            'subheading' => 'nullable|string',
            'file_upload' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:10240', // Adjust file types and size as needed
            'background_image' => 'nullable|file|mimes:jpg,png,jpeg|max:10240', // Adjust file types and size as needed
            'description' => 'nullable|string',
            'section2_heading' => 'nullable|string',
            'section2_content' => 'nullable|array',
            'section2_content.*.question' => 'nullable|string',
            'section2_content.*.answer' => 'nullable|string',
            'section3_heading' => 'nullable|string',
            'testimonial_description' => 'nullable|array',
            'testimonial_description.*' => 'exists:testimonials,id', // Ensure testimonial exists in the testimonials table
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'seo_heading' => 'nullable|string',
            'seo_description' => 'nullable|string',
        ]);

        $fileUploadPath = null;
        if ($request->hasFile('file_upload')) {
            $fileUploadPath = $request->hasFile('file_upload') ? $imageUploadService->storeImage($request->file('file_upload'), 'images',97): "";
        }

        $backgroundImagePath = null;
        if ($request->hasFile('background_image')) {
            $backgroundImagePath = $request->hasFile('background_image') ? $imageUploadService->storeImage($request->file('background_image'), 'images',97): "";
        }

        $sectionIIBgImagePath = null;
        if ($request->hasFile('section_ii_background_image')) {
            $sectionIIBgImagePath = $request->hasFile('section_ii_background_image') ? $imageUploadService->storeImage($request->file('section_ii_background_image'), 'images',97): "";
        }

        $featured_image = null;
        if ($request->hasFile('featured_image')) {
            $featured_image = $request->hasFile('featured_image') ? $imageUploadService->storeImage($request->file('featured_image'), 'images',97): "";
        }

        // dd($request->section2_content);

        $report = ReportIndividual::create([
            'heading' => $validatedData['heading'],
            'slug' => Str::slug($validatedData['heading']),
            'featured_image' => $featured_image,
            'subheading' => $validatedData['subheading'] ?? null,
            'file_upload' => $fileUploadPath,
            'background_image' => $backgroundImagePath,
            'section_ii_background_image' => $sectionIIBgImagePath, 
            'description' => $validatedData['description'],
            'html_code'=> $request->html_code,
            'section2_heading' => $validatedData['section2_heading'] ?? null,
            'section2_content' => $request->section2_content ? json_encode($request->section2_content) : null,
            'section3_heading' => $validatedData['section3_heading'] ?? null,
            'testimonial_description' => json_encode($validatedData['testimonial_description'] ?? []),
            'meta_title' => $validatedData['meta_title'] ?? null,
            'meta_description' => $validatedData['meta_description'] ?? null,
            'seo_heading' => $validatedData['seo_heading'] ?? null,
            'seo_description' => $validatedData['seo_description'] ?? null,
        ]);


        return redirect()->route('report_inidividual.index')->with('success', 'Report created successfully!');
    }

    public function edit($id)
    {
        $report = ReportIndividual::findOrFail($id);
        $testimonials = Testimonial::all();
        return view('reportindividual.edit', compact('report','testimonials'));
    }

    public function update(Request $request, $id, ImageUploadService $imageUploadService)
    {
        $report = ReportIndividual::findOrFail($id);
        $validatedData = $request->validate([
            'heading' => 'required|string',
            'subheading' => 'nullable|string',
            'file_upload' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:10240', // Adjust file types and size as needed
            'background_image' => 'nullable|file|mimes:jpg,png,jpeg|max:10240', // Adjust file types and size as needed
            'description' => 'nullable|string',
            'section2_heading' => 'nullable|string',
            'section2_content' => 'nullable|array',
            'section2_content.*.question' => 'nullable|string',
            'section2_content.*.answer' => 'nullable|string',
            'section3_heading' => 'nullable|string',
            'testimonial_description' => 'nullable|array',
            'testimonial_description.*' => 'exists:testimonials,id', // Ensure testimonial exists in the testimonials table
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'seo_heading' => 'nullable|string',
            'seo_description' => 'nullable|string',
        ]);
        $report->update([
            'heading' => $validatedData['heading'],
            'slug' => Str::slug($validatedData['heading']),
            'subheading' => $validatedData['subheading'] ?? null,
            'file_upload' => $request->hasFile('file_upload') ? $imageUploadService->storeImage($request->file('file_upload'), 'images',97): $report->file_upload,
            'featured_image' => $request->hasFile('featured_image') ? $imageUploadService->storeImage($request->file('featured_image'), 'images',97): $report->featured_image,
            'background_image' => $request->hasFile('background_image') ? $imageUploadService->storeImage($request->file('background_image'), 'images',97): $report->background_image,
            'section_ii_background_image' => $request->hasFile('section_ii_background_image') ? $imageUploadService->storeImage($request->file('section_ii_background_image'), 'images',97): $report->section_ii_background_image, 
            'description' => $validatedData['description'],
            'section2_heading' => $validatedData['section2_heading'] ?? null,
            'html_code'=> $request->html_code,
            'section2_content' => $request->section2_content ? json_encode($request->section2_content) : null,
            'section3_heading' => $validatedData['section3_heading'] ?? null,
            'testimonial_description' => json_encode($validatedData['testimonial_description'] ?? []),
            'meta_title' => $validatedData['meta_title'] ?? null,
            'meta_description' => $validatedData['meta_description'] ?? null,
            'seo_heading' => $validatedData['seo_heading'] ?? null,
            'seo_description' => $validatedData['seo_description'] ?? null,
        ]);
        return redirect()->route('report_inidividual.index')->with('success', 'Report updated successfully!');
    }

    public function destroy($id)
    {
        $report = ReportIndividual::findOrFail($id);
        $report->delete();
        return redirect()->route('report_inidividual.index')->with('success', 'Report deleted successfully!');
    }
}
