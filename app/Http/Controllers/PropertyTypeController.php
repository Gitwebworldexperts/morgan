<?php

namespace App\Http\Controllers;

use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($category)
    {
        if(!$category){
            return redirect()->back()->with('error', 'Property category not Found!');
        }
        $propertyTypes = PropertyType::where('property',$category)->get();
        return view('admin.property_types.index', compact('propertyTypes','category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($category)
    {
        if(isset($category) && !empty($category)){
            return view('admin.property_types.create',compact('category'));
        }else{
            return redirect()->back()->with('success', 'Property category not Found!');
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'type_name' => 'required|string|max:255',
            'property' => 'required|nullable',
            'status' => 'boolean'
        ]);

        $propertyType = PropertyType::create($request->all());
        return redirect()->back()->with('success', 'Property type saved successfully!');
        // return response()->json($propertyType, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyType $propertyType)
    {
        return view('admin.property_types.edit', compact('propertyType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'type_name' => 'required|string|max:255',
            'property' => 'nullable',
            'status' => 'boolean'
        ]);

        // Find the existing property type by ID
        $propertyType = PropertyType::findOrFail($id);

        // Update the property type with the validated data
        $propertyType->update($request->all());

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Property type updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the existing property type by ID
        $propertyType = PropertyType::findOrFail($id);

        // Delete the property type
        $propertyType->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Property type deleted successfully!');
    }

}
