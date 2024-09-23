<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectPropertie;
use App\Models\PropertyType;
use App\Models\Banners;

class ProjectPropertieController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->property = 'project';
        // $this->middleware('auth');
    } 

      public function index()
        {
            $propertie = ProjectPropertie::orderBy('id', 'desc')->with('propertyType')->get();
            return view('admin.project_propertie.propertie', compact('propertie'));
         }

        public function create()
        {
            $propertyTypes = PropertyType::where('property',$this->property)->get();
            if(!count($propertyTypes)){
                return redirect()->back()->with('error', 'Please create property type');   
            }

            return view('admin.project_propertie.create',compact('propertyTypes'));
        }

        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                'google_maps_link' => 'nullable|url',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'featured_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                // 'area' => 'nullable|numeric',
                'jacuzzi' => 'nullable|boolean',
                'bed' => 'nullable|integer',
                'price' => 'nullable|numeric',
                'sale_price' => 'nullable|numeric',
                'is_featured' => 'nullable|boolean',
                'is_private' => 'nullable|boolean',
                // 'country_id' => 'nullable|exists:countries,id',
                'category_id' => 'required',
            ]);
            // Create a new property instance
            $property = new ProjectPropertie();
            $property->name = $request->name;
            $property->address = $request->address;
            $property->google_maps_link = $request->google_maps_link;
            $property->area = $request->area;
            $property->jacuzzi = $request->has('jacuzzi');
            $property->bed = $request->input('bed', 0); // Default to 0 if not provided
            $property->price = $request->price;
            $property->sale_price = $request->sale_price;
            $property->is_featured = $request->has('is_featured');
            $property->is_private = $request->has('is_private');
            $property->country_id = $request->country_id;
            $property->category_id = $request->category_id;

            // Save the property to the database to get the ID
            $property->save();

            // Store regular images and create banners
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $image) {
                    $timestamp = now()->timestamp;
                    $extension = $image->getClientOriginalExtension();
                    $newFileName = 'image_' . $timestamp. $key . '.' . $extension;
                    $image->move(public_path('images'), $newFileName);
                    
                    // Store the image path in the banners table
                    $banner = new Banners();
                    $banner->image_url = 'images/' . $newFileName;
                    // $banner->page_id = 1; // Set the appropriate page_id if needed
                    $banner->property_id = $property->id; // Associate with the newly created property
                    $banner->save();
                }
            }

            // Store featured image
            if ($request->hasFile('featured_image')) {
                $featuredImage = $request->file('featured_image');
                $timestamp = now()->timestamp;
                $extension = $featuredImage->getClientOriginalExtension();
                $newFileName = 'featured_image_' . $timestamp . '.' . $extension;
                $featuredImage->move(public_path('featured_images'), $newFileName);
                $property->featured_image = 'featured_images/' . $newFileName;

                // Optionally, you can also save the featured image as a banner
                $banner = new Banners();
                $banner->image_url = 'featured_images/' . $newFileName;
                // $banner->page_id = 1; // Set the appropriate page_id if needed
                $banner->property_id = $property->id; // Associate with the newly created property
                $banner->save();
            }

            // Save the property again if needed to update the featured image
            $property->save();


            return redirect()->back()->with('success', 'Property created successfully!');
        }


        public function edit($id)
        {
            $property = ProjectPropertie::findOrFail($id);
            if(!$property){
                return redirect()->back()->with('error', 'Private property not found!');
            }
            $property->load('banners');
            $propertyTypes = PropertyType::where('property',$this->property)->get();
            return view('admin.project_propertie.edit', compact('property','propertyTypes'));
        }


        public function update(Request $request, $id)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                'google_maps_link' => 'nullable|url',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'featured_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'area' => 'nullable|numeric',
                'jacuzzi' => 'nullable|boolean',
                'bed' => 'nullable|integer',
                'price' => 'nullable|numeric',
                'sale_price' => 'nullable|numeric',
                'country_id' => 'nullable|exists:countries,id',
                'category_id' => 'required|exists:property_types,id',
            ]);

            // Find the property to update
            $property = ProjectPropertie::findOrFail($id);

            // Update the property fields
            $property->name = $request->name;
            $property->address = $request->address;
            $property->google_maps_link = $request->google_maps_link;
            $property->area = $request->area;
            $property->jacuzzi = $request->has('jacuzzi');
            $property->bed = $request->input('bed', 0);
            $property->price = $request->price;
            $property->is_featured = ($request->has('is_featured'))?$request->has('is_featured'):0;
            $property->is_private = ($request->has('is_private'))?$request->has('is_private'):0;
            $property->sale_price = $request->sale_price;
            $property->country_id = $request->country_id;
            $property->category_id = $request->category_id;
            // dd($request->file('images'));
             if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $image) {
                    $timestamp = now()->timestamp;
                    $extension = $image->getClientOriginalExtension();
                    $newFileName = 'image_' . $timestamp. $key . '.' . $extension;
                    $image->move(public_path('images'), $newFileName);
                    
                    // Store the image path in the banners table
                    $banner = new Banners();
                    $banner->image_url = 'images/' . $newFileName;
                    // $banner->page_id = 1; // Set the appropriate page_id if needed
                    $banner->property_id = $property->id; // Associate with the newly created property
                    $banner->save();
                }
            }

            // Store featured image
            if ($request->hasFile('featured_image')) {
                $featuredImage = $request->file('featured_image');
                $timestamp = now()->timestamp;
                $extension = $featuredImage->getClientOriginalExtension();
                $newFileName = 'featured_image_' . $timestamp . '.' . $extension;
                $featuredImage->move(public_path('featured_images'), $newFileName);
                $property->featured_image = 'featured_images/' . $newFileName;

                // Optionally, you can also save the featured image as a banner
                $banner = new Banners();
                $banner->image_url = 'featured_images/' . $newFileName;
                // $banner->page_id = 1; // Set the appropriate page_id if needed
                $banner->property_id = $property->id; // Associate with the newly created property
                $banner->save();
            }


            // Save the updated property to the database
            $property->save();

            return redirect()->back()->with('success', 'Property updated successfully!');
        }


        public function destroy($id)
        {
            $property = ProjectPropertie::findOrFail($id);
            if(!$property){
                return redirect()->back()->with('error', 'Private property not found!');
            }
            $property->delete();
            $existingBanners = Banners::where('property_id', $property->id)->get();
            // Delete existing banners and unlink their images
            foreach ($existingBanners as $banner) {
                $imagePath = public_path($banner->image_url);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $banner->delete();
            }
            return redirect()->back()->with('success', 'Property delete successfully');
        }
}
