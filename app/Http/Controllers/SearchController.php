<?php

namespace App\Http\Controllers;

use App\Models\RentPropertie;
use App\Models\BuyPropertie;
use App\Models\ProjectPropertie;
use App\Models\BrandedPropertie;
use App\Models\PrivatePropertie;
use App\Models\InternationalPropertie;
use App\Models\PropertyType;
use App\Models\ListingDetail;
use App\Models\InvestmentPropertie;
use App\Models\Banners;
use App\Models\Region;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
    //   dd($request);
        $this->page_title = '';
        $propFor = $request->input('prop_for');
        $region = $request->query('region'); 
         

         
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
            'rent' => RentPropertie::class,
            'project' => ProjectPropertie::class,
            'private' => PrivatePropertie::class,
            'international' => InternationalPropertie::class,
            'sales' => BuyPropertie::class,
            'branded' => BrandedPropertie::class,
            'investment' => InvestmentPropertie::class
        ];
        $regions = [];
        // Check if the requested property type exists
        if (array_key_exists($propFor, $propertyTypes)) {
            // Fetch properties with pagination
            if($propFor == "international" && !empty($region)){
                //  $regions = Region::whereIn('id', $regionIds)->get();

                $properties = $propertyTypes[$propFor]::where('region',$region)->orderBy('id', 'desc')->with('propertyType')->paginate(12);
            }else{
                // $properties = $propertyTypes[$propFor]::orderBy('id', 'desc')->with('propertyType')->paginate(12);
            $properties = $propertyTypes[$propFor]::query()
                ->when($request->sort, function ($query) use ($request) {
                    return $query->orderBy('sale_price', $request->sort); // Apply sorting based on the sort parameter
                })
                ->when($request->property_type, function ($query) use ($request) {
                    return $query->whereHas('propertyType', function ($query) use ($request) {
                        $query->whereIn('id', $request->property_type); // Filter by propertyType.id
                    });
                })
                ->when($request->size, function ($query) use ($request) {
                    return $query->whereIn('property_size', $request->size); // Filter by property_size array
                })
                ->when($request->min_range, function ($query) use ($request) {
                    return $query->where('sale_price', '>=', $request->min_range); // Filter by min_range
                })
                ->when($request->max_range, function ($query) use ($request) {
                    return $query->where('sale_price', '<=', $request->max_range); // Filter by max_range
                })
                ->with('propertyType')
                ->paginate(12);



            }
            $property_type = '';                                                                
            if($propFor == "rent"){
                $property_type_name = 'rent';
                $private_listing = ListingDetail::where('id',8)->first();
                $property_type = PropertyType::where('status',1)->where('property','rent')->get();
            }elseif($propFor == "project"){
                $property_type_name = 'project';
                $private_listing = ListingDetail::where('id',12)->first();
                $property_type = PropertyType::where('status',1)->where('property','project')->get();
            }elseif($propFor == "private"){
                $property_type_name = 'private';
                $private_listing = ListingDetail::where('id',1)->first();
                $property_type = PropertyType::where('status',1)->where('property','private')->get();
            }elseif($propFor == "international"){
                $regions = Region::all();
                $property_type_name = 'international';
                $private_listing = ListingDetail::where('id',11)->first();
                $property_type = PropertyType::where('status',1)->where('property','international')->get();
            }elseif($propFor == "sales"){
                $property_type_name = 'buy';
                $private_listing = ListingDetail::where('id',9)->first();
                $property_type = PropertyType::where('status',1)->where('property','buy')->get();
            }elseif($propFor == "branded"){
                $property_type_name = 'branded';
                $private_listing = ListingDetail::where('id',14)->first();
                $property_type = PropertyType::where('status',1)->where('property','branded')->get();
            }elseif($propFor == "investment"){
                $property_type_name = 'investment';
                $private_listing = ListingDetail::where('id',15)->first();
                $property_type = PropertyType::where('status',1)->where('property','branded')->get();
            }
            $data = [
                'page_title' => ucfirst($propFor) . " Properties",
                'page_type' => $propFor,
                'detail' => $private_listing,
                'property' => $properties,
                'property_type' => $property_type,
                'property_name' => $propFor,
                'title' => ucfirst($propFor) . " "
            ];

            $filter_array = [
                'sort' => !empty($request->sort) ? $request->sort : '',
                'property_type' => !empty($request->property_type) ? $request->property_type : [],
                'size' => !empty($request->size) ? $request->size : [],
                'min_range' => !empty($request->min_range) ? $request->min_range : '',
                'max_range' => !empty($request->max_range) ? $request->max_range : '',
            ];

            // Pass 'prop_for' through the pagination links
            $properties->appends(['prop_for' => $propFor]);

            // Return view directly with paginated data
            return view('search', compact('data','property_type_name','regions','filter_array'));
        } else {
            return redirect()->route('home');    
        }
    }

    public function CommonSearch(Request $request){
        $property_type_id = $request->property_type ? (int) $request->property_type : null;
        $buy = $request->buy ? (int) $request->buy : null;
        $bed = $request->bed ? (int) $request->bed : null;
        $price = $request->price ? (int) $request->price : null;
        $location = $request->location;
        
            $property_type = PropertyType::find($property_type_id);

            $this->page_title = '';
            $propFor = isset($property_type->property) ? $property_type->property : $request->property_name;
            $pagination = $request->input('page');
    
            // Check if pagination was requested and set propFor if needed
            if ($pagination) {
                $previousUrl = url()->previous();
                parse_str(parse_url($previousUrl, PHP_URL_QUERY), $queryParams);
                $propFor = $queryParams['prop_for'] ?? null;
            }
        
            $propertyTypes = [
                'rent' => RentPropertie::class,
                'project' => ProjectPropertie::class,
                'private' => PrivatePropertie::class,
                'international' => InternationalPropertie::class,
                'sales' => BuyPropertie::class,
                'buy' => BuyPropertie::class,
            ];
            // var_dump($propFor);die;
            // Check if the requested property type exists
            if (array_key_exists($propFor, $propertyTypes)) {
                // Fetch properties with pagination
                // $properties = $propertyTypes[$propFor]::orderBy('id', 'desc')->with('propertyType')->paginate(12); // Change to your desired items per page
                 

                $properties = $propertyTypes[$propFor]::when($property_type_id, function ($query) use ($property_type_id) {
                    $query->whereHas('propertyType', function ($query) use ($property_type_id) {
                        $query->where('id', $property_type_id);
                    });
                })
                ->when($location, function ($query) use ($location) {
                    $query->where('address', 'like', '%' . $location . '%');
                })
                ->when($bed, function ($query) use ($bed) {
                    $query->where('bed', '=', $bed);
                })
                ->orderBy('id', 'desc')
                ->with('propertyType')
                ->paginate(12);
                                
                $property_type = $request->property_type ? (int) $request->property_type : null;
                $buy = $request->buy ? (int) $request->buy : null;
                $bed = $request->bed ? (int) $request->bed : null;
                $price = $request->price ? (int) $request->price : null;

                if($propFor == "rent"){
                    $private_listing = ListingDetail::where('id',8)->first();
                    $property_type = PropertyType::where('status',1)->where('property','rent')->get();
                }elseif($propFor == "project"){
                    $private_listing = ListingDetail::where('id',12)->first();
                    $property_type = PropertyType::where('status',1)->where('property','project')->get();
                }elseif($propFor == "private"){
                    $private_listing = ListingDetail::where('id',1)->first();
                    $property_type = PropertyType::where('status',1)->where('property','private')->get();
                }elseif($propFor == "international"){
                    $private_listing = ListingDetail::where('id',1)->first();
                    $property_type = PropertyType::where('status',1)->where('property','international')->get();
                }elseif($propFor == "sales" || $propFor ==  "buy"){
                    $private_listing = ListingDetail::where('id',9)->first();
                    $property_type = PropertyType::where('status',1)->where('property','buy')->get();
                }



                $data = [
                    'page_title' => ucfirst($propFor) . " Properties",
                    'page_type' => $propFor,
                    'detail' => $private_listing,
                    'property' => $properties,
                    'property_type' => $property_type,
                    'title' => ucfirst($propFor) . " "
                ];
    
                // Pass 'prop_for' through the pagination links
                $properties->appends(['prop_for' => $propFor]);
                
                $searchData = ['buy'=>$buy,'property_name' => $request->property_name,'property_type'=>$property_type,'property_type_id'=>$property_type_id,'bed'=>$bed,'price'=>$price,'location'=>$location];
                // Return view directly with paginated data
                // dd($property_type_id);
                $filter_array = [
                    'sort' => !empty($request->sort) ? $request->sort : '',
                    'property_type' => !empty($request->property_type) ? [$request->property_type] : [],
                    'size' => !empty($request->size) ? $request->size : [],
                    'min_range' => !empty($request->min_range) ? $request->min_range : '',
                    'max_range' => !empty($request->max_range) ? $request->max_range : '',
                ];
                return view('search')->with(['data'=>$data,'searchData'=>$searchData,'property_type_name'=>$propFor,'filter_array'=>$filter_array]);
            } else {
                return redirect()->route('home');    
            }
    }



}
