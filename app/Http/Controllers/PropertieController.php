<?php
namespace App\Http\Controllers;

use App\Models\Properties;

use App\Models\RentPropertie;
use App\Models\PrivatePropertie;
use App\Models\Community;
use App\Models\ProjectPropertie;
use App\Models\InternationalPropertie;
use App\Models\InvestmentPropertie;
use App\Models\BuyPropertie;
use App\Models\ListingDetail;
use App\Models\Agent;
use App\Models\Report;
use App\Models\ReportIndividual;
use DB;
use App\Models\PrivateOffice;
use App\Models\PropertyType;
use App\Models\Amenitie;
use App\Models\Banners;
use App\Models\PageBrandedResidence;
use App\Models\BrandedPropertie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PropertieController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->property = 'master';
        // $this->middleware('auth');
    }
    public function index()
    {
        $propertie = Properties::orderBy('id', 'desc')->with('propertyType')->get();
        return view('admin.propertie.propertie', compact('propertie'));
     }

    public function create()
    {
        $propertyTypes = PropertyType::where('property',$this->property)->get();
        return view('admin.propertie.create',compact('propertyTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            // 'google_maps_link' => 'nullable|url',
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
        $property = new Properties();
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


    public function edit(Properties $property)
    {
        // Eager load the banners associated with the property
        $property->load('banners');
        $propertyTypes = PropertyType::where('property',$this->property)->get();
        return view('admin.propertie.edit', compact('property','propertyTypes'));
    }


    public function update(Request $request, $id)
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
        ]);

        // Find the property to update
        $property = Properties::findOrFail($id);

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


    public function destroy(Properties $property)
    {
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

    public function bannerDestroy($property,$banner)
    {

        if(!isset($property)){
            return response()->json(['message' => 'Delete Request Not for this property.'], 404);
        }
        // $property = Properties::find($property);
        // if(!$property){
        //     return response()->json(['message' => 'Associated property not found.'], 404);
        // }
        $banner_list = Banners::where('property_id', $property)->where('id',$banner)->first();
        $banner_list->delete();
        return response()->json(['message' => 'Banner deleted successfully.'], 200);
    }

    public function DetailPage(Request $request,$pageName){
        $properties = [
            RentPropertie::where('slug', 'LIKE', '%' . $pageName . '%')->with(['banners', 'propertyType','community'])->first(),
            PrivatePropertie::where('slug', 'LIKE', '%' . $pageName . '%')->with(['banners', 'propertyType','community'])->first(),
            ProjectPropertie::where('slug', 'LIKE', '%' . $pageName . '%')->with(['banners', 'propertyType','company','plans','community'])->first(),
            InternationalPropertie::where('slug', 'LIKE', '%' . $pageName . '%')->with(['banners', 'propertyType','community'])->first(),
            BuyPropertie::where('slug', 'LIKE', '%' . $pageName . '%')->with(['banners', 'propertyType','community'])->first(),
            BrandedPropertie::where('slug', 'LIKE', '%' . $pageName . '%')->with(['banners', 'propertyType','community'])->first()
        ];        
        
        $amenitie = Amenitie::where('status','1')->get();
        $foundProperty = $agent = null;
        
        foreach ($properties as $property) {
            if ($property) {
                $foundProperty = $property;
                if(isset($foundProperty->agent) && !empty($foundProperty->agent)){
                    $agent = Agent::find($foundProperty->agent);
                }
                break; // Exit the loop on first found property
            }
        }
        
        if ($foundProperty) {
            $tableName = $foundProperty->getTable();

            if($tableName == "rent_properties"){
                $property_type = 'rent';
            }elseif($tableName == "private_properties"){
                $property_type = 'private';
            }elseif($tableName == "project_properties"){
                $property_type = 'project';
            }elseif($tableName == "international_properties"){
                $property_type = 'international';
            }elseif($tableName == "buy_properties"){
                $property_type = 'buy';
            }elseif($tableName == "branded_properties"){
                $property_type = 'branded';
            }
            // $property_list = DB::table($tableName)->limit(10)->get();
            
            $property_list = DB::table($tableName)
    ->leftJoin('property_types', $tableName . '.category_id', '=', 'property_types.id') 
    ->select(
        $tableName . '.*',
        'property_types.id as property_type_id', // Alias the id column of property_types
        'property_types.type_name as type_name',
        $tableName . '.id as property_id'        // Alias the id column of the main table
    )
    ->where($tableName . '.id', '!=', $foundProperty->id) 
    ->limit(10)
    ->get();

            return view('detail', compact('foundProperty','agent','property_list','amenitie','property_type'));
        } else {
            echo "Error: Property not found.";
            die;
        }
        die;
    }

    public function DevlopmentDetailPage(Request $request,$pageName){
        $properties = [
            ProjectPropertie::where('slug', 'LIKE', '%' . $pageName . '%')->with(['banners', 'propertyType','company','plans'])->first(),
        ];        
        
        $amenitie = Amenitie::where('status','1')->get();
        $foundProperty = $agent = null;
        
        foreach ($properties as $property) {
            if ($property) {
                $foundProperty = $property;
                if(isset($foundProperty->agent) && !empty($foundProperty->agent)){
                    $agent = Agent::find($foundProperty->agent);
                }
                break; // Exit the loop on first found property
            }
        }
        
        if ($foundProperty) {
            $tableName = $foundProperty->getTable();
            if($tableName == "rent_properties"){
                $property_type = 'rent';
            }elseif($tableName == "private_properties"){
                $property_type = 'private';
            }elseif($tableName == "project_properties"){
                $property_type = 'project';
            }elseif($tableName == "international_properties"){
                $property_type = 'international';
            }elseif($tableName == "buy_properties"){
                $property_type = 'buy';
            }elseif($tableName == "branded_properties"){
                $property_type = 'branded';
            }
            // $property_list = DB::table($tableName)->limit(10)->get();
            // dd($foundProperty);
            $property_list = DB::table($tableName)
    ->leftJoin('property_types', $tableName . '.category_id', '=', 'property_types.id') 
    ->select(
        $tableName . '.*',
        'property_types.id as property_type_id', // Alias the id column of property_types
        'property_types.type_name as type_name',
        $tableName . '.id as property_id'        // Alias the id column of the main table
    )
    ->limit(10)
    ->get();

            $devlopment = "";
            // dd($property_list);
            return view('detail', compact('foundProperty','agent','property_list','amenitie','devlopment','property_type'));
        } else {
            echo "Error: Property not found.";
            die;
        }
        die;
    }

    public function PrivateDetailPage(Request $request,$pageName){
        $properties = [
            PrivatePropertie::where('slug', 'LIKE', '%' . $pageName . '%')->with(['banners', 'propertyType'])->first(),
        ];        
        
        $amenitie = Amenitie::where('status','1')->get();
        $foundProperty = $agent = null;
        
        foreach ($properties as $property) {
            if ($property) {
                $foundProperty = $property;
                if(isset($foundProperty->agent) && !empty($foundProperty->agent)){
                    $agent = Agent::find($foundProperty->agent);
                }
                break; // Exit the loop on first found property
            }
        }
        
        if ($foundProperty) {
            $tableName = $foundProperty->getTable();
            if($tableName == "rent_properties"){
                $property_type = 'rent';
            }elseif($tableName == "private_properties"){
                $property_type = 'private';
            }elseif($tableName == "project_properties"){
                $property_type = 'project';
            }elseif($tableName == "international_properties"){
                $property_type = 'international';
            }elseif($tableName == "buy_properties"){
                $property_type = 'buy';
            }elseif($tableName == "branded_properties"){
                $property_type = 'branded';
            }
            // $property_list = DB::table($tableName)->limit(10)->get();
            // dd($foundProperty);
            $property_list = DB::table($tableName)
    ->leftJoin('property_types', $tableName . '.category_id', '=', 'property_types.id') 
    ->select(
        $tableName . '.*',
        'property_types.id as property_type_id', // Alias the id column of property_types
        'property_types.type_name as type_name',
        $tableName . '.id as property_id'        // Alias the id column of the main table
    )
    ->limit(10)
    ->get();


            $private = "";
            // dd($property_list);
            return view('detail', compact('foundProperty','agent','property_list','amenitie','private','property_type'));
        } else {
            echo "Error: Property not found.";
            die;
        }
        die;
    }

    public function InvestmentDetailPage(Request $request,$pageName){
        $properties = [
            InvestmentPropertie::where('slug', 'LIKE', '%' . $pageName . '%')->with(['banners', 'propertyType'])->first(),
        ];        
        
        $amenitie = Amenitie::where('status','1')->get();
        $foundProperty = $agent = null;
        
        foreach ($properties as $property) {
            if ($property) {
                $foundProperty = $property;
                if(isset($foundProperty->agent) && !empty($foundProperty->agent)){
                    $agent = Agent::find($foundProperty->agent);
                }
                break; // Exit the loop on first found property
            }
        }
        
        if ($foundProperty) {
            $tableName = $foundProperty->getTable();
            if($tableName == "rent_properties"){
                $property_type = 'rent';
            }elseif($tableName == "private_properties"){
                $property_type = 'private';
            }elseif($tableName == "project_properties"){
                $property_type = 'project';
            }elseif($tableName == "international_properties"){
                $property_type = 'international';
            }elseif($tableName == "buy_properties"){
                $property_type = 'buy';
            }elseif($tableName == "branded_properties"){
                $property_type = 'branded';
            }elseif($tableName == "investment_properties"){
                $property_type = 'investment';
            }
            // $property_list = DB::table($tableName)->limit(10)->get();
            // dd($foundProperty);
            $property_list = DB::table($tableName)
    ->leftJoin('property_types', $tableName . '.category_id', '=', 'property_types.id') 
    ->select(
        $tableName . '.*',
        'property_types.id as property_type_id', // Alias the id column of property_types
        'property_types.type_name as type_name',
        $tableName . '.id as property_id'        // Alias the id column of the main table
    )
    ->limit(10)
    ->get();

            $investment = "";
            // dd($property_list);
            return view('detail', compact('foundProperty','agent','property_list','amenitie','investment','property_type'));
        } else {
            echo "Error: Property not found.";
            die;
        }
        die;
    }

    public function PrivateListing(Request $request){
        $propertyTypes = PropertyType::where('property',$this->property)->get();
        $this->page_title = 'Private Listing';
        $propFor = 'private';
        $pagination = $request->input('page');

        // Check if pagination was requested and set propFor if needed
        if ($pagination) {
            $previousUrl = url()->previous();
            parse_str(parse_url($previousUrl, PHP_URL_QUERY), $queryParams);
        }

        // Redirect if propFor is empty
        if (empty($propFor)) {
            return redirect()->route('home');
        }

        $propertyTypes = [
            'private' => PrivatePropertie::class
        ];

        // Check if the requested property type exists
        if (array_key_exists($propFor, $propertyTypes)) {
            // Fetch properties with pagination
            $properties = $propertyTypes[$propFor]::orderBy('id', 'desc')->with('propertyType')->paginate(12); // Change to your desired items per page

            $property_type = PropertyType::where('status',1)->where('property','private')->get();
            
            $private_listing = ListingDetail::where('id',1)->first();

            $data = [
                'page_title' => ucfirst($propFor) . " Properties",
                'page_type' => $propFor,
                'detail' => $private_listing,
                'property' => $properties,
                'property_type' => $property_type,
                'property_name' => $propFor,
                'title' => ucfirst($propFor) . " "
            ];

            // Pass 'prop_for' through the pagination links
            $properties->appends(['prop_for' => $propFor]);

            $private = ""; 
            $property_type_name = "private";
            $filter_array = [
                'sort' => !empty($request->sort) ? $request->sort : '',
                'property_type' => !empty($request->property_type) ? $request->property_type : [],
                'size' => !empty($request->size) ? $request->size : [],
                'min_range' => !empty($request->min_range) ? $request->min_range : '',
                'max_range' => !empty($request->max_range) ? $request->max_range : '',
            ];
            // Return view directly with paginated data
            return view('search', compact('data','private','property_type_name','filter_array'));
        } else {
            return redirect()->route('home');    
        }
        die;
    }



    public function InvestmentListing(Request $request){
        $propertyTypes = PropertyType::where('property',$this->property)->get();
        $this->page_title = 'Investment Listing';
        $propFor = 'invest';
        $pagination = $request->input('page');

        // Check if pagination was requested and set propFor if needed
        if ($pagination) {
            $previousUrl = url()->previous();
            parse_str(parse_url($previousUrl, PHP_URL_QUERY), $queryParams);
        }

        // Redirect if propFor is empty
        if (empty($propFor)) {
            return redirect()->route('home');
        }

        $propertyTypes = [
            'invest' => InvestmentPropertie::class
        ];

        // Check if the requested property type exists
        if (array_key_exists($propFor, $propertyTypes)) {
            // Fetch properties with pagination
            $properties = $propertyTypes[$propFor]::orderBy('id', 'desc')->with('propertyType')->paginate(12); // Change to your desired items per page

            $property_type = PropertyType::where('status',1)->where('property','investment')->get();
            
            $private_listing = ListingDetail::where('id',15)->first();

            $data = [
                'page_title' => ucfirst($propFor) . " Properties",
                'page_type' => $propFor,
                'detail' => $private_listing,
                'property' => $properties,
                'property_type' => $property_type,
                'property_name' => $propFor,
                'title' => ucfirst($propFor) . " "
            ];

            // Pass 'prop_for' through the pagination links
            $properties->appends(['prop_for' => $propFor]);

            $private = ""; 
            $property_type_name = "investment";
            $filter_array = [
                'sort' => !empty($request->sort) ? $request->sort : '',
                'property_type' => !empty($request->property_type) ? $request->property_type : [],
                'size' => !empty($request->size) ? $request->size : [],
                'min_range' => !empty($request->min_range) ? $request->min_range : '',
                'max_range' => !empty($request->max_range) ? $request->max_range : '',
            ];
            // Return view directly with paginated data
            return view('search', compact('data','property_type_name','filter_array'));
        } else {
            return redirect()->route('home');    
        }
        die;
    }

    public function DevelopmentListing(Request $request){
        
        if($request->query('company')){
            $companyId = base64_decode($request->query('company'));
        }
        $propertyTypes = PropertyType::where('property',$this->property)->get();
        $this->page_title = 'Development Listing';
        $propFor = 'project';
        $pagination = $request->input('page');

        // Check if pagination was requested and set propFor if needed
        if ($pagination) {
            $previousUrl = url()->previous();
            parse_str(parse_url($previousUrl, PHP_URL_QUERY), $queryParams);
        }

        // Redirect if propFor is empty
        if (empty($propFor)) {
            return redirect()->route('home');
        }

        $propertyTypes = [
            'project' => ProjectPropertie::class,
        ];
        // Check if the requested property type exists
        if (array_key_exists($propFor, $propertyTypes)) {
            // Fetch properties with pagination
            if(isset($companyId)){
                $properties = $propertyTypes[$propFor]::where('company_id',$companyId)->orderBy('id', 'desc')->with('propertyType')->paginate(12); // Change to your desired items per page
            }else{
                $properties = $propertyTypes[$propFor]::orderBy('id', 'desc')->with('propertyType')->paginate(12); // Change to your desired items per page
            }
        
                $top_listing = $propertyTypes[$propFor]::orderBy('id', 'desc')->with('propertyType')->latest()->take(5)->get()->map(function ($item) {
                    $item['property_source'] = 'project';
                    return $item;
                });
        
            $property_type = PropertyType::where('status',1)->where('property','project')->get();
            
            
            $private_listing = ListingDetail::where('id',12)->first();
            $data = [
                'page_title' => ucfirst($propFor) . " Properties",
                'page_type' => $propFor,
                'detail' => $private_listing,
                'property' => $properties,
                'property_type' => $property_type,
                'property_name' => $propFor,
                'title' => ucfirst($propFor) . " "
            ];

            // Pass 'prop_for' through the pagination links
            $properties->appends(['prop_for' => $propFor]);
            $devlopment = "";
             $filter_array = [
                'sort' => !empty($request->sort) ? $request->sort : '',
                'property_type' => !empty($request->property_type) ? $request->property_type : [],
                'size' => !empty($request->size) ? $request->size : [],
                'min_range' => !empty($request->min_range) ? $request->min_range : '',
                'max_range' => !empty($request->max_range) ? $request->max_range : '',
            ];


            // Return view directly with paginated data
            return view('search', compact('data','devlopment','top_listing','filter_array'));
        } else {
            return redirect()->route('home');    
        }

        die;
    }

    public function BrandedResidences(Request $request){

        $propertyTypes = PropertyType::where('property','branded')->get();
        $this->page_title = 'Branded Residences';
        $propFor = 'branded';
        $pagination = $request->input('page');

        // Check if pagination was requested and set propFor if needed
        if ($pagination) {
            $previousUrl = url()->previous();
            parse_str(parse_url($previousUrl, PHP_URL_QUERY), $queryParams);
            $propFor = $queryParams['prop_for'] ?? null;
        }

        // Redirect if propFor is empty
        if (empty($propFor)) {
            return redirect()->route('home');
        }

        $propertyTypes = [
            'branded' => BrandedPropertie::class,
        ];
        $pageBrandedResidence = PageBrandedResidence::latest()->first();
        
        // $properties = $propertyTypes[$propFor]::orderBy('id', 'desc')->with('propertyType')->paginate(12); // Change to your desired items per page
        

        $properties = BrandedPropertie::where('status', 'active')
        ->where('is_featured',1)
        ->take(10)
        ->get()->map(function ($item) {
            $item['property_source'] = 'branded';
            return $item;
        })
        ->merge(
            ProjectPropertie::where('status', 'active')
                ->where(['is_featured' => 1,'is_branded' => 1])
                ->take(10)
                ->get()->map(function ($item) {
                    $item['property_source'] = 'project';
                    return $item;
                })
        )
        ->sortByDesc('created_at');
        $page = request()->get('page', 1); // Get the current page or default to 1
        $perPage = 100; // Number of items per page
        $paginatedProperties = new LengthAwarePaginator(
            $properties->forPage($page, $perPage), // Slice the collection for the current page
            $properties->count(), // Total number of items
            $perPage, // Items per page
            $page, // Current page
            ['path' => request()->url(), 'query' => request()->query()] // Pagination URL and query params
        );
        


            $property_type = PropertyType::where('status',1)->where('property','branded')->get();
            
            $data = [
                'page_title' => ucfirst($propFor) . " Properties",
                'page_type' => $propFor,
                'property' => $paginatedProperties,
                'property_type' => $property_type,
                'property_name' => $propFor,
                'title' => ucfirst($propFor) . " ",
                'propFor' => $propFor,
                'page_data' => $pageBrandedResidence
            ];

            // Pass 'prop_for' through the pagination links
            // $properties->appends(['prop_for' => $propFor]);
            
        return view('branded_residences', compact('data','propFor'));
    } 

    public function PrivateOffices(Request $request){
        $propertyTypes = PropertyType::where('property',$this->property)->get();
        $this->page_title = 'Private Listing';
        $propFor = 'private';
        $pagination = $request->input('page');

        // Check if pagination was requested and set propFor if needed
        if ($pagination) {
            $previousUrl = url()->previous();
            parse_str(parse_url($previousUrl, PHP_URL_QUERY), $queryParams);
        }

        // Redirect if propFor is empty
        if (empty($propFor)) {
            return redirect()->route('home');
        }

        $propertyTypes = [
            'private' => PrivatePropertie::class
        ];

            // Fetch properties with pagination
            $properties = $propertyTypes[$propFor]::orderBy('id', 'desc')->with('propertyType')->paginate(12); // Change to your desired items per page

            $property_type = PropertyType::where('status',1)->where('property','private')->get();
            
            $private_listing = ListingDetail::where('id',1)->first();

            $data = [
                'page_title' => ucfirst($propFor) . " Properties",
                'page_type' => $propFor,
                'detail' => $private_listing,
                'property' => $properties,
                'property_type' => $property_type,
                'property_name' => $propFor,
                'title' => ucfirst($propFor) . " "
            ];



            // Pass 'prop_for' through the pagination links
            $properties->appends(['prop_for' => $propFor]);

            $privateOffice = PrivateOffice::latest()->first();
            $private_properties = PrivatePropertie::where('status', 'active')->where('is_featured', 1)
            ->latest()
            ->take(6)
            ->with('propertyType')
            ->get();
        
            // Return view directly with paginated data
            return view('PrivateOffice', compact('data','privateOffice','private_properties'));

    }

    public function Communities(Request $request){
        $data = [];

        $data['communities'] =  Community::paginate(12);
        return view('communitie_listing', compact('data'));
    }

    public function CommunitieDetail($id){
        $id = base64_decode($id);
        // base64_encode
        $data = [];
        $data['communities'] =  Community::find($id);
        if(!$data['communities']){
            return redirect()->route('communities.listing');
        }

        // Fetch data for each property type and add a 'property_source' key
        $brandedProperties = BrandedPropertie::where('community_id', $id)
            ->where('is_featured','1')
            ->with(['banners', 'propertyType'])
            ->take(3)
            ->get()
            ->map(function ($item) {
                $item['property_source'] = 'branded';
                return $item;
            });

        $investmentPropertie = InvestmentPropertie::where('community_id', $id)
        ->where('is_featured','1')
        ->with(['banners', 'propertyType'])
        ->take(3)
        ->get()
        ->map(function ($item) {
            $item['property_source'] = 'invest';
            return $item;
        });

        $rentProperties = RentPropertie::where('community_id', $id)
            ->where('is_featured','1')
            ->with(['banners', 'propertyType'])
            ->take(3)
            ->get()
            ->map(function ($item) {
                $item['property_source'] = 'rent';
                return $item;
            });

        $privateProperties = PrivatePropertie::where('community_id', $id)
            ->where('is_featured','1')
            ->with(['banners', 'propertyType'])
            ->take(3)
            ->get()
            ->map(function ($item) {
                $item['property_source'] = 'private';
                return $item;
            });

        $projectProperties = ProjectPropertie::where('community_id', $id)
            ->where('is_featured','1')
            ->with(['banners', 'propertyType'])
            ->take(3)
            ->get()
            ->map(function ($item) {
                $item['property_source'] = 'project';
                return $item;
            });

        $internationalProperties = InternationalPropertie::where('community_id', $id)
            ->where('is_featured','1')
            ->with(['banners', 'propertyType'])
            ->take(3)
            ->get()
            ->map(function ($item) {
                $item['property_source'] = 'international';
                return $item;
            });

        $buyProperties = BuyPropertie::where('community_id', $id)
            ->where('is_featured','1')    
            ->with(['banners', 'propertyType'])
            ->take(3)
            ->get()
            ->map(function ($item) {
                $item['property_source'] = 'buy';
                return $item;
            });

        // Merge all arrays into a single array
        $allProperties = array_merge(
            $brandedProperties->toArray(),
            $rentProperties->toArray(),
            $privateProperties->toArray(),
            $projectProperties->toArray(),
            $investmentPropertie->toArray(),
            $internationalProperties->toArray(),
            $buyProperties->toArray()
        );

        // Now each item in $allProperties will have a 'property_source' key indicating its origin


        return view('communitie_detail', compact('data','allProperties'));
    }

    public function ReportList(){
        $report = Report::latest()->first();
        $reports = ReportIndividual::where('status', 'active')
        ->select('report_type', 'slug', 'background_image', 'heading')
        ->get();    
        return view('reports', compact('report','reports'));
    }
}
