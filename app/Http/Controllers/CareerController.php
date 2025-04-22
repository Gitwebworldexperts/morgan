<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Services\ImageUploadService;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use App\Mail\JobMail;
use Illuminate\Support\Facades\Mail;


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

        
        $slug = generateSlug($request->job_name, \App\Models\Career::class);
        
        Career::create($request->merge(['slug' => $slug])->all());


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
            'form' => 'max:0',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'experience' => 'nullable|string|max:255',
            'contact_number' => 'required|string|max:15',
            'resume' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);
    
        $careeer = Career::find(base64_decode($validatedData['career_id']));
        if(!$careeer){
            return back()->with('error', 'Application form not found!');
        }
        
        // Handle file upload
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }
    
        // Save to the database
        $jobApplication = JobApplication::create([
            'career_id' => base64_decode($validatedData['career_id']),
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'experience' => $validatedData['experience'],
            'contact_number' => $validatedData['contact_number'],
            'resume_path' => $request->hasFile('resume') ? $imageUploadService->storeImage($request->file('resume'), 'resume'): null,
        ]);
        
        $previousUrl = url()->previous();
        
        $data = [
            'name' => $validatedData['full_name'] ?? "",
            'email' => $validatedData['email'],
            'phone' => $validatedData['contact_number'],
            'message' => $request->input('message', ''),
            'url' => $previousUrl,
            'careeer' => $careeer, 
            'ip_address' => $request->ip(),
        ];
        
        $adminEmail = env('APP_ADMIN', 'yesvant@webworldexpertsindia.com');
        // $adminEmail = 'morgansrealty@gmail.com';
        // $adminEmail =  'hr@morgansrealty.com';
        $adminEmail =  'careers@morgansrealty.com';

        // Send the FormMail with the form data and attached resume
        $verify = Mail::to($adminEmail)->send(new JobMail($data, $jobApplication->resume_path));
        
        
        return back()->with('success', 'Application submitted successfully!');
    }
    
    public function genericSubmit(Request $request, ImageUploadService $imageUploadService)
    {
        $validatedData = $request->validate([
            'form' => 'max:0',
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
        $jobApplication = JobApplication::create([
            'career_id' => isset($validatedData['career_id']) ? base64_decode($validatedData['career_id']) : 0,
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'experience' => $validatedData['experience'],
            'contact_number' => $validatedData['contact_number'],
            'resume_path' => $request->hasFile('resume') ? $imageUploadService->storeImage($request->file('resume'), 'resume'): null,
        ]);
        
        $previousUrl = url()->previous();
        
        $data = [
            'name' => $validatedData['full_name'] ?? "",
            'email' => $validatedData['email'],
            'phone' => $validatedData['contact_number'],
            'message' => $request->input('message', ''),
            'url' => $previousUrl,
            'careeer' => $careeer ?? '', 
            'ip_address' => $request->ip(),
        ];
        
        $adminEmail = env('APP_ADMIN', 'yesvant@webworldexpertsindia.com');
        // $adminEmail = 'morgansrealty@gmail.com';
        $adminEmail =  'hr@morgansrealty.com';

        // Send the FormMail with the form data and attached resume
        $verify = Mail::to($adminEmail)->send(new JobMail($data, $jobApplication->resume_path));
        
        
        return back()->with('success', 'Application submitted successfully!');
    }

    public function AppliedJob($id){
         // Ensure the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('admin.login')->with('error', 'You must be logged in to view the job applications.');
        }
        $id = base64_decode($id);
        $careeer = Career::find($id);
        $list = JobApplication::where('career_id', $id)
                      ->orderBy('id', 'desc')
                      ->get();
        return view('careers.list', compact('list','careeer'));
    }
    
    public function GenericAppliedJob(){
        if (!auth()->check()) {
            return redirect()->route('admin.login')->with('error', 'You must be logged in to view the job applications.');
        }
        $list = JobApplication::where('career_id', 0)
                      ->orderBy('id', 'desc')
                      ->get();
        return view('careers.generic.list', compact('list'));
    }

}
