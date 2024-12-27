<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Services\ImageUploadService;

class ReportController extends Controller
{
    // Show the form to create a new report
    public function index()
    {
        $report = Report::latest()->first();                
        return view('reports.create',compact('report'));
    }

    // Store the newly created report
    public function store(Request $request, ImageUploadService $imageUploadService)
    {
        // Validate the incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'read_more' => 'nullable|string',
            'section1_heading' => 'required|string',
            'section1_image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'section1_content_1' => 'nullable|string',
            'section1_title_1' => 'nullable|string',
            // Continue validating other fields as needed...
        ]);
    
        // Handle file uploads
        $data = $request->all();
        $report = Report::latest()->first();  // Get the most recent report
    
        // Handle background image if present
        if ($request->hasFile('background')) {
            $data['background'] = $imageUploadService->storeImage($request->file('background'), 'images');
        } else {
            $data['background'] = $report->background ?? '';  // Use the previous report's background if available
        }
    
        // Loop through sections to handle images
        $sectionCounts = [
            'section1' => 3, // Section 1 has 3 images
            'section2' => 6, // Section 2 has 6 images
        ];
    
        foreach ($sectionCounts as $section => $imageCount) {
            for ($i = 1; $i <= $imageCount; $i++) {
                $imageField = $section . '_image_' . $i;
    
                // Check if the file exists and store it
                if ($request->hasFile($imageField)) {
                    $data[$imageField] = $imageUploadService->storeImage($request->file($imageField), $section . '_images', $i);
                } else {
                    // Use the previous report's image if it exists, otherwise set it to an empty string
                    $data[$imageField] = $report->{$imageField} ?? '';
                }
            }
        }
    
        // Create a new report with the data
        $report = Report::create($data);
    
        // Redirect with success message
        return redirect()->route('reports.create', $report->id)->with('success', 'Report created successfully!');
    }
    
}
