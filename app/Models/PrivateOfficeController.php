<?php
// app/Http/Controllers/PrivateOfficeController.php
namespace App\Http\Controllers;

use App\Models\PrivateOffice;
use Illuminate\Http\Request;

class PrivateOfficeController extends Controller
{
    // Show the form to create a new private office page
    public function create()
    {
        return view('private_offices.create');
    }

    // Store a new private office page
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'expert_image' => 'nullable|image',
            'expert_name' => 'required|string|max:255',
            'expert_post' => 'required|string|max:255',
            'contact_link' => 'nullable|url',
            'section_2_heading' => 'required|string|max:255',
            'expert_description' => 'required|string',
            'mastery_description' => 'required|string',
            'result_description' => 'required|string',
            'access_description' => 'required|string',
            'confidentiality_description' => 'required|string',
            'legal_description' => 'required|string',
            'section_3_heading' => 'required|string|max:255',
            'input_fields' => 'nullable|array',
        ]);

        if ($request->hasFile('expert_image')) {
            $imagePath = $request->file('expert_image')->store('expert_images', 'public');
        } else {
            $imagePath = null;
        }

        PrivateOffice::create([
            'name' => $request->name,
            'description' => $request->description,
            'expert_image' => $imagePath,
            'expert_name' => $request->expert_name,
            'expert_post' => $request->expert_post,
            'contact_link' => $request->contact_link,
            'section_2_heading' => $request->section_2_heading,
            'expert_description' => $request->expert_description,
            'mastery_description' => $request->mastery_description,
            'result_description' => $request->result_description,
            'access_description' => $request->access_description,
            'confidentiality_description' => $request->confidentiality_description,
            'legal_description' => $request->legal_description,
            'section_3_heading' => $request->section_3_heading,
            'input_fields' => $request->input_fields,
        ]);

        return redirect()->route('private_offices.index')->with('success', 'Private Office page created successfully!');
    }

    // Show the form to edit an existing private office page
    public function edit($id)
    {
        $privateOffice = PrivateOffice::findOrFail($id);
        return view('private_offices.edit', compact('privateOffice'));
    }

    // Update an existing private office page
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'expert_image' => 'nullable|image',
            'expert_name' => 'required|string|max:255',
            'expert_post' => 'required|string|max:255',
            'contact_link' => 'nullable|url',
            'section_2_heading' => 'required|string|max:255',
            'expert_description' => 'required|string',
            'mastery_description' => 'required|string',
            'result_description' => 'required|string',
            'access_description' => 'required|string',
            'confidentiality_description' => 'required|string',
            'legal_description' => 'required|string',
            'section_3_heading' => 'required|string|max:255',
            'input_fields' => 'nullable|array',
        ]);

        $privateOffice = PrivateOffice::findOrFail($id);

        if ($request->hasFile('expert_image')) {
            // Delete the old image if a new one is uploaded
            if ($privateOffice->expert_image) {
                \Storage::delete('public/' . $privateOffice->expert_image);
            }

            $imagePath = $request->file('expert_image')->store('expert_images', 'public');
        } else {
            $imagePath = $privateOffice->expert_image;
        }

        $privateOffice->update([
            'name' => $request->name,
            'description' => $request->description,
            'expert_image' => $imagePath,
            'expert_name' => $request->expert_name,
            'expert_post' => $request->expert_post,
            'contact_link' => $request->contact_link,
            'section_2_heading' => $request->section_2_heading,
            'expert_description' => $request->expert_description,
            'mastery_description' => $request->mastery_description,
            'result_description' => $request->result_description,
            'access_description' => $request->access_description,
            'confidentiality_description' => $request->confidentiality_description,
            'legal_description' => $request->legal_description,
            'section_3_heading' => $request->section_3_heading,
            'input_fields' => $request->input_fields,
        ]);

        return redirect()->route('private_offices.index')->with('success', 'Private Office page updated successfully!');
    }
}
