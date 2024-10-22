<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:applications,email',
            'experience' => 'required|string',
            'contact_number' => 'required|string|max:20',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes');
        }

        Application::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'experience' => $request->experience,
            'contact_number' => $request->contact_number,
            'resume' => $resumePath,
        ]);

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }
}
