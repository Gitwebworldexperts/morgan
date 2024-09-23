<?php

namespace App\Http\Controllers;
use App\Models\HeaderSections;
use App\Models\HomePage;
use App\Models\Properties;
use App\Models\PrivatePropertie;
use App\Models\ProjectPropertie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $headerSections = HeaderSections::first();
        $featured_properties = Properties::getFeaturedProperties();
        // $private_properties = PrivatePropertie::getPrivateProperties(4,'id');
        $private_properties = PrivatePropertie::latest()->take(4)->get();
        $project_properties = ProjectPropertie::latest()->take(4)->get();
        $home = HomePage::orderBy('id','desc')->first();
        return view('welcome', compact('headerSections','featured_properties','private_properties','home','project_properties'));
    }
}
