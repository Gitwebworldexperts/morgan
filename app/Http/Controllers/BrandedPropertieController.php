<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrandedPropertie;
use App\Models\PropertyType;

use App\Models\Amenitie;
use App\Models\Banners;
use App\Models\Agent;
class BrandedPropertieController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->property = 'branded';
        // $this->middleware('auth');
    } 

     public function index()
        {
            $propertie = BrandedPropertie::orderBy('id', 'desc')->with('propertyType')->get();
            return view('admin.branded_propertie.propertie', compact('propertie'));
         }

        public function create()
        {
            $propertyTypes = PropertyType::where('property',$this->property)->get();
            $agents = Agent::all();
            if(!count($propertyTypes)){
                return redirect()->back()->with('error', 'Please create property type');   
            }
        $agents = Agent::all();
        $amenitie = Amenitie::where('status','1')->get();
            return view('admin.branded_propertie.create',compact('propertyTypes','agents','amenitie'));
        }

        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string',
            // 'google_maps_link' => 'nullable|url',
            // 'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
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
        $slug = generateSlug($request->name."_branded", \App\Models\BrandedPropertie::class);
            // Create a new property instance
            // dd($request);
            $property = new BrandedPropertie();
        $property->status = $request->status; 
        $property->property_size = $request->property_size;
            $property->name = $request->name;
            $property->community_id = $request->community_id;
            $property->meta_title = $request->meta_title;
            $property->meta_description2 = $request->meta_description2;
        $property->slug = $slug;
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

        $property->description = $request->property_description;
        $property->amenities_id =  ($request->amenities_id)? implode(', ', $request->amenities_id) :'';
        $property->agent = $request->agent_id;
        $property->meta_tags = $request->meta_tags;

        $property->information_heading = $request->eighth_heading;
        $property->information_description = $request->eighth_description;
        $property->information_button_label = $request->eighth_section_button;
        $property->information_button_url = $request->eighth_section_button_2;
        $property->information_button_label_2 = $request->eighth_section_button_3;
        $property->information_button_url_2 = $request->eighth_section_button_3_2;
            $property->save();

            // Store regular images and create banners
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $key => $image) {
                    $timestamp = now()->timestamp;
                    $extension = $image->getClientOriginalExtension();
                    $newFileName = 'image_' . $timestamp. $key . '.' . $extension;
                    $image->move('images/', $newFileName);
                    
                    // Store the image path in the banners table
                    $banner = new Banners();
                    $banner->image_url = 'images/' . $newFileName;
                    $banner->page_type = 'branded'; // Set the appropriate page_id if needed
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
                $featuredImage->move('featured_images/', $newFileName);
                $property->featured_image = 'featured_images/' . $newFileName;

                // Optionally, you can also save the featured image as a banner
                $banner = new Banners();
                $banner->image_url = 'featured_images/' . $newFileName;
            	$banner->page_type = 'branded';
                $banner->property_id = $property->id; // Associate with the newly created property
                $banner->save();
            }

        if ($request->hasFile('floor_plan')) {
            $floor_plan = $request->file('floor_plan');
            $timestamp = now()->timestamp;
            $extension = $floor_plan->getClientOriginalExtension();
            $newFileName = 'floor_plan_' . $timestamp . '.' . $extension;
            $floor_plan->move('floor_plan/', $newFileName);
            $property->floor_plan = 'floor_plan/' . $newFileName;
        }

        if ($request->hasFile('brochure')) {
            $featuredImage = $request->file('brochure');
            $timestamp = now()->timestamp;
            $extension = $featuredImage->getClientOriginalExtension();
            $newFileName = 'brochure_' . $timestamp . '.' . $extension;
            $featuredImage->move('brochure/', $newFileName);
            $property->brochure = 'brochure/' . $newFileName;
        }

        if ($request->hasFile('blog_background')) {
            $blog_background = $request->file('blog_background');
            $timestamp = now()->timestamp;
            $extension = $blog_background->getClientOriginalExtension();
            $newFileName = 'blog_background_' . $timestamp . '.' . $extension;
            $blog_background->move('blog_background/', $newFileName);
            $property->blog_background = 'blog_background/' . $newFileName;
        }
            // Save the property again if needed to update the featured image
            $property->save();

            return redirect()->action([__CLASS__, 'index'])->with('success', 'Property created successfully!');


            // return redirect()->back()->with('success', 'Property created successfully!');
        }


        public function edit($id)
        {
            $property = BrandedPropertie::findOrFail($id);
            $agents = Agent::all();
            if(!$property){
                return redirect()->back()->with('error', 'Private property not found!');
            }
            $property->load('banners');
            $propertyTypes = PropertyType::where('property',$this->property)->get();
	        $agents = Agent::all();
	        $amenitie = Amenitie::where('status','1')->get();
            return view('admin.branded_propertie.edit', compact('property','propertyTypes','agents','amenitie'));
        }


        public function update_old(Request $request, $id)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string',
                // 'google_maps_link' => 'nullable|url',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'featured_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'area' => 'nullable|numeric',
                'jacuzzi' => 'nullable|boolean',
                'bed' => 'nullable|integer',
                'price' => 'nullable|numeric',
                'sale_price' => 'nullable|numeric',
                'country_id' => 'nullable|exists:countries,id',
                'category_id' => 'required|exists:property_types,id',
                // 'slug' => 'required',
                'agent_id' => 'required',
                'information_heading' => 'required',
                'information_description' => 'required',
            ]);

            // Find the property to update
            $property = BuyPropertie::findOrFail($id);

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



            $property->description = $request->description;
            // $property->slug = $request->slug;
            $property->agent = $request->agent_id;
            $property->information_heading = $request->information_heading;
            $property->information_description = $request->information_description;
            $property->information_button_label = $request->information_button_label;
            $property->information_button_url = $request->information_button_label_2;


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

    public function update(Request $request, $id)
    {
        // dd($request);
    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'required|string',
        // 'google_maps_link' => 'nullable|url',
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
    $property = BrandedPropertie::findOrFail($id);
    $property->status = $request->status; 
    $property->property_size = $request->property_size;
    // Update the property fields
    $property->name = $request->name;
    $property->community_id = $request->community_id;
    $property->meta_title = $request->meta_title;
    $property->meta_description2 = $request->meta_description2;
    $property->address = $request->address;
    $property->google_maps_link = $request->google_maps_link;
    $property->area = $request->area;
    $property->bed = $request->input('bed', 0);
    $property->price = $request->price;
    $property->sale_price = $request->sale_price;
    $property->jacuzzi = $request->has('jacuzzi');
    $property->is_featured = $request->has('is_featured') ? $request->has('is_featured') : 0;
    $property->is_private = $request->has('is_private') ? $request->has('is_private') : 0;
    $property->country_id = $request->country_id;
    $property->category_id = $request->category_id;

    // Update property description and other fields
    $property->description = $request->property_description;
    $property->amenities_id = $request->has('amenities_id') ? implode(', ', $request->amenities_id) : "";
    // $property->amenities_id = $request->has('amenities_id') ? implode(', ', $request->amenities_id) : $property->amenities_id;
    $property->agent = $request->agent_id;
    $property->meta_tags = $request->meta_tags;

    // Information fields
    $property->information_heading = $request->eighth_heading;
    $property->information_description = $request->eighth_description;
    $property->information_button_label = $request->eighth_section_button;
    $property->information_button_url = $request->eighth_section_button_2;
    $property->information_button_label_2 = $request->eighth_section_button_3;
    $property->information_button_url_2 = $request->eighth_section_button_3_2;

    // Handle images and banners (like in the store method)
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $key => $image) {
            $timestamp = now()->timestamp;
            $extension = $image->getClientOriginalExtension();
            $newFileName = 'image_' . $timestamp . $key . '.' . $extension;
            $image->move('images/', $newFileName);

            // Store the image path in the banners table
            $banner = new Banners();
            $banner->image_url = 'images/' . $newFileName;
            $banner->page_type = 'branded'; // Set the appropriate page_id if needed
            $banner->property_id = $property->id; // Associate with the updated property
            $banner->save();
        }
    }

    // Handle featured image update
    if ($request->hasFile('featured_image')) {
        $featuredImage = $request->file('featured_image');
        $timestamp = now()->timestamp;
        $extension = $featuredImage->getClientOriginalExtension();
        $newFileName = 'featured_image_' . $timestamp . '.' . $extension;
        $featuredImage->move('featured_images/', $newFileName);
        $property->featured_image = 'featured_images/' . $newFileName;

        // Optionally, you can also save the featured image as a banner
        $banner = new Banners();
        $banner->image_url = 'featured_images/' . $newFileName;
        $banner->page_type = 'branded';
        $banner->property_id = $property->id;
        $banner->save();
    }

    // Handle other file uploads (floor plan, brochure, blog background)
    if ($request->hasFile('floor_plan')) {
        $floor_plan = $request->file('floor_plan');
        $timestamp = now()->timestamp;
        $extension = $floor_plan->getClientOriginalExtension();
        $newFileName = 'floor_plan_' . $timestamp . '.' . $extension;
        $floor_plan->move('floor_plan', $newFileName);
        $property->floor_plan = 'floor_plan/' . $newFileName;
    }

    if ($request->hasFile('brochure')) {
        $brochure = $request->file('brochure');
        $timestamp = now()->timestamp;
        $extension = $brochure->getClientOriginalExtension();
        $newFileName = 'brochure_' . $timestamp . '.' . $extension;
        $brochure->move('brochure/', $newFileName);
        $property->brochure = 'brochure/' . $newFileName;
    }

    if ($request->hasFile('blog_background')) {
        $blog_background = $request->file('blog_background');
        $timestamp = now()->timestamp;
        $extension = $blog_background->getClientOriginalExtension();
        $newFileName = 'blog_background_' . $timestamp . '.' . $extension;
        $blog_background->move('blog_background/', $newFileName);
        $property->blog_background = 'blog_background/' . $newFileName;
    }

    // Save the updated property to the database
    $property->save();

    return redirect()->back()->with('success', 'Property updated successfully!');
}



    public function destroy($id)
    {
        $property = BrandedPropertie::findOrFail($id);
        if(!$property){
            return redirect()->back()->with('error', 'Private property not found!');
        }
        $property->delete();
        // $existingBanners = Banners::where('property_id', $property->id)->get();
        // // Delete existing banners and unlink their images
        // foreach ($existingBanners as $banner) {
        //     $imagePath = public_path($banner->image_url);
        //     if (file_exists($imagePath)) {
        //         unlink($imagePath);
        //     }
        //     $banner->delete();
        // }
            return redirect()->back()->with('success', 'Property delete successfully');
        }
}
