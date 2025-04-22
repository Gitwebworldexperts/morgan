<?php

namespace App\Http\Controllers;
use App\Models\HeaderSections;
use App\Models\HomePage;
use App\Models\Properties;
use App\Models\PrivatePropertie;
use App\Models\ProjectPropertie;
use App\Models\PropertyType;
use App\Models\Region;
use App\Models\RentPropertie;
use App\Models\BuyPropertie;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\InternationalPropertie;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->getQueryString()) {
            return redirect()->to(url()->current(), 301); // Permanent redirect to clean URL
        }
            // Header section (not expected to change often)
        $headerSections = Cache::remember('header_sections', 600, function () {
            return HeaderSections::first();
        });
    
        // Featured Rent Properties
        $rentProperties = Cache::remember('featured_rent_properties', 300, function () {
            return RentPropertie::where('rent_properties.status', 'active')
                ->where('rent_properties.is_featured', 1)
                ->leftJoin('property_types', 'rent_properties.category_id', '=', 'property_types.id')
                ->select(
                    'rent_properties.*',
                    'property_types.id as property_type_id',
                    'property_types.type_name as type_name',
                    'rent_properties.id as property_id'
                )
                ->with('banners')
                ->take(10)
                ->get()
                ->map(function ($item) {
                    $item['property_source'] = 'rent';
                    return $item;
                });
        });
    
        // Featured Buy Properties
        $buyProperties = Cache::remember('featured_buy_properties', 300, function () {
            return BuyPropertie::where('buy_properties.status', 'active')
                ->where('buy_properties.is_featured', 1)
                ->leftJoin('property_types', 'buy_properties.category_id', '=', 'property_types.id')
                ->select(
                    'buy_properties.*',
                    'property_types.id as property_type_id',
                    'property_types.type_name as type_name',
                    'buy_properties.id as property_id'
                )
                ->with('banners')
                ->take(10)
                ->get()
                ->map(function ($item) {
                    $item['property_source'] = 'buy';
                    return $item;
                });
        });
    
        $featured_properties = $rentProperties->merge($buyProperties)->sortByDesc('created_at');
    
        // Region IDs (used?)
        $regionIds = Cache::remember('international_region_ids', 600, function () {
            return InternationalPropertie::where('status', 'active')
                ->distinct('region')
                ->pluck('region')
                ->take(10);
        });
    
        // All regions
        $regions = Cache::remember('all_regions', 600, function () {
            return Region::all();
        });
    
        // Featured Private Properties
        $private_properties = Cache::remember('featured_private_properties', 300, function () {
            return PrivatePropertie::where('status', 'active')
                ->where('is_featured', 1)
                ->latest()
                ->take(4)
                ->get()
                ->map(function ($item) {
                    $item['property_source'] = 'private';
                    return $item;
                });
        });
    
        // Featured Project Properties
        $project_propertie = Cache::remember('featured_project_properties', 300, function () {
            return ProjectPropertie::where('status', 'active')
                ->where('is_featured', 1)
                ->latest()
                ->take(10)
                ->get()
                ->map(function ($item) {
                    $item['property_source'] = 'project';
                    return $item;
                });
        });
    
        // Latest International Properties
        $propertie = Cache::remember('latest_international_properties', 300, function () {
            return InternationalPropertie::where('status', 'active')
                ->orderBy('id', 'desc')
                ->with('propertyType')
                ->take(4)
                ->get()
                ->map(function ($item) {
                    $item['property_source'] = 'international';
                    return $item;
                });
        });
    
        // Private property types
        $PrivatePropertyTypes = Cache::remember('private_property_types', 600, function () {
            return PropertyType::where('property', 'private')->get();
        });
    
        // Blog posts
        $posts = Cache::remember('latest_blog_posts', 300, function () {
            return Post::latest()->take(4)->get();
        });
    
        // Home page content/config
        $home = Cache::remember('homepage_content', 600, function () {
            return HomePage::orderBy('id', 'desc')->first();
        });
    
        return view('welcome', compact(
            'posts',
            'headerSections',
            'featured_properties',
            'PrivatePropertyTypes',
            'private_properties',
            'home',
            'project_propertie',
            'regions'
        ));
    }
    
}
