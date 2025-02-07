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
    public function index()
    {
        $headerSections = HeaderSections::first();
        // $featured_properties = Properties::getFeaturedProperties();
            $featured_properties = RentPropertie::where('status', 'active')
            ->where('is_featured', 1)
            ->with('banners') // Load the related banners for RentPropertie
            ->take(10)
            ->get()
            ->map(function ($item) {
                $item['property_source'] = 'rent';
                return $item;
            })
            ->merge(
                BuyPropertie::where('status', 'active')
                    ->where('is_featured', 1)
                    ->with('banners') // Load the related banners for BuyPropertie
                    ->take(10)
                    ->get()
                    ->map(function ($item) {
                        $item['property_source'] = 'buy';
                        return $item;
                    })
            )
            ->sortByDesc('created_at');
                    
        // Get the distinct region IDs from the InternationalPropertie model (taking the first 10).
        $regionIds = InternationalPropertie::distinct('region')->pluck('region')->take(10);
        
        // Get the Region models that match the region IDs obtained from the first query.
        // $regions = Region::whereIn('id', $regionIds)->get();
        $regions = Region::all();

        
        // $private_properties = PrivatePropertie::getPrivateProperties(4,'id');
        $private_properties = PrivatePropertie::where('status', 'active')->where('is_featured',1)->latest()->take(4)->get()->map(function ($item) {
            $item['property_source'] = 'private';
            return $item;
        });
        $project_propertie = ProjectPropertie::where('status', 'active')->where('is_featured',1)->latest()->take(10)->get()->map(function ($item) {
            $item['property_source'] = 'project';
            return $item;
        });
        $propertie = InternationalPropertie::orderBy('id', 'desc')->with('propertyType')->take(4)->get()->map(function ($item) {
            $item['property_source'] = 'international';
            return $item;
        });
        $PrivatePropertyTypes = PropertyType::where('property','private')->get();

        // $region = Post::with('tags')
        // ->whereHas('tags', function($query) {
        //     $query->where('name', 'Region');
        // })
        // ->latest()
        // ->take(5)
        // ->get();

        $posts = Post::latest()->take(4)->get();
        // $posts = [];
        $project_properties = ProjectPropertie::where('status', 'active')->where('is_featured',1)->latest()->take(10)->get()->map(function ($item) {
            $item['property_source'] = 'project';
            return $item;
        });
        
        $home = HomePage::orderBy('id','desc')->first();
        return view('welcome', compact('posts','headerSections','featured_properties','PrivatePropertyTypes','private_properties','home','project_propertie','regions'));
    }
}
