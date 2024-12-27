<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Services\ImageUploadService;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    // Display a list of careers
    public function index()
    {
        $careers = Career::all();
        return view('careers.index', compact('careers'));
    }

    // Show the form to create a new career
    public function create()
    {
        return view('careers.create');
    }

    // Store a newly created career
    public function store(Request $request)
    {
        $request->validate([
            'job_name' => 'required|string|max:255',
            'job_type' => 'required|string|max:255',
            'job_location' => 'required|string|max:255',
            'description' => 'required|string',
            'position' => 'required|string',
            'responsibilities' => 'required|string',
            'status' => 'nullable|string|max:50',
        ]);

        Career::create($request->all());

        return redirect()->route('careers.index')->with('success', 'Career created successfully.');
    }

    // Show the form to edit a career
    public function edit(Career $career)
    {
        return view('careers.edit', compact('career'));
    }

    // Update the specified career
    public function update(Request $request, Career $career)
    {
        $request->validate([
            'job_name' => 'required|string|max:255',
            'job_type' => 'required|string|max:255',
            'job_location' => 'required|string|max:255',
            'description' => 'required|string',
            'responsibilities' => 'required|string',
            'status' => 'nullable|string|max:50',
        ]);

        $career->update($request->all());

        return redirect()->route('careers.index')->with('success', 'Career updated successfully.');
    }

    // Delete a career
    public function destroy(Career $career)
    {
        $career->delete();

        return redirect()->route('careers.index')->with('success', 'Career deleted successfully.');
    }

    public function submit(Request $request, ImageUploadService $imageUploadService)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'career_id' => 'required',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'experience' => 'nullable|string|max:255',
            'contact_number' => 'required|string|max:15',
            'resume' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);
    
        // Handle file upload
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }
    
        // Save to the database
        JobApplication::create([
            'career_id' => base64_decode($validatedData['career_id']),
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'experience' => $validatedData['experience'],
            'contact_number' => $validatedData['contact_number'],
            'resume_path' => $request->hasFile('resume') ? $imageUploadService->storeImage($request->file('resume'), 'resume'): null,
        ]);
    
        // Return a response
        return back()->with('success', 'Application submitted successfully!');
    }

    public function AppliedJob($id){
        $id = base64_decode($id);
        $careeer = Career::find($id);
        $list = JobApplication::where('career_id',$id)->get();
        return view('careers.list', compact('list','careeer'));
    }

}
