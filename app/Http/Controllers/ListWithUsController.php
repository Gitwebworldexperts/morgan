<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListWithUs;

class ListWithUsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|string|max:20',
            'property_type' => 'required|string',
            'bedrooms' => 'nullable|integer',
            'area' => 'nullable|string',
            'building_name' => 'nullable|string|max:255',
        ]);

        ListWithUs::create($request->all());

        return redirect()->back()->with('success', 'Your information has been submitted successfully!');
    }

    public function listWithUsData(){
        $contact = ListWithUs::orderBy('id', 'desc')->paginate(10);
        return view('admin.list_with_us_data', compact('contact')); 
    }
}
