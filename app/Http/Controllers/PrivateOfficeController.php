<?php
// app/Http/Controllers/PrivateOfficeController.php
namespace App\Http\Controllers;

use App\Models\PrivateOffice;
use Illuminate\Http\Request;
use App\Services\ImageUploadService;

class PrivateOfficeController extends Controller
{
    // Show the form to create a new private office page
    public function index()
    {
        $privateOffice = PrivateOffice::latest()->first();
        return view('private_offices.create', compact('privateOffice'));
    }

    // Store a new private office page
    public function store(Request $request,ImageUploadService $imageUploadService)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'expert_image' => 'nullable|image',
            'expert_name' => 'required|string|max:255',
            'expert_post' => 'required|string|max:255',
            'contact_link' => 'nullable',
            'section_2_heading' => 'required|string|max:255',
            'expert_description' => 'required|string',
            'mastery_description' => 'required|string',
            'result_description' => 'required|string',
            'access_description' => 'required|string',
            'confidentiality_description' => 'required|string',
            'legal_description' => 'required|string',
            'section_3_heading' => 'required|string|max:255',
        ]);


        if ($request->hasFile('expert_image')) {
            $imagePath = $request->file('expert_image')->store('expert_images', 'public');
        } else {
            $imagePath = null;
        }

        $po = PrivateOffice::latest()->first();
            $section_1_image = "";
        if(isset($po->expert_image) && !empty($po->expert_image)){
            $section_1_image = $po->expert_image;
        }

        $imagePath = $request->hasFile('expert_image') ? $imageUploadService->storeImage($request->file('expert_image'), 'images'): $section_1_image;



        $json = [];

        for ($i = 0; $i < 5; $i++) {
            // Check if both 'percentage_heading' and 'percentage' are set and not empty
            if (isset($request->percentage_heading[$i]) && !empty($request->percentage_heading[$i]) &&
                isset($request->percentage[$i]) && !empty($request->percentage[$i])) {
                $json[] = [$request->percentage[$i] =>$request->percentage_heading[$i]];
            }
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
            'input_fields' => json_encode($json),
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
            'contact_link' => 'nullable',
            'section_2_heading' => 'required|string|max:255',
            'expert_description' => 'required|string',
            'mastery_description' => 'required|string',
            'result_description' => 'required|string',
            'access_description' => 'required|string',
            'confidentiality_description' => 'required|string',
            'legal_description' => 'required|string',
            'section_3_heading' => 'required|string|max:255',
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
