<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomePage;
use App\Services\ImageUploadService;

class HomePageController extends Controller
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
     * Display a listing of the resource.
     */
    public function index()
    {

        $home = HomePage::orderBy('id','desc')->first();
        return view('admin.pages.home',compact('home'));   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function createButton($buttonName, $buttonUrl) {
        if($buttonName || $buttonUrl){
            return [
                "buttonName" => $buttonName ?? '',
                "buttonUrl" => $buttonUrl ?? ''
            ];
        }else{
            return '';
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ImageUploadService $imageUploadService)
    {
        // Validate the request data
        $validatedData = $request->validate([
            // 'section_1' => 'required|in:0,1',
            // 'first_section_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'first_section_heading' => 'required|string|max:255',
            // 'section_2' => 'required|in:0,1',
            'second_heading' => 'required|string|max:255',
            'second_description' => 'nullable|string',
            // 'second_section_button' => 'nullable|json',
            // 'third_section_button' => 'nullable|json',
            // 'section_4' => 'required|in:0,1',
            'fourth_heading' => 'required|string|max:255',
            // 'toggle_private_property' => 'required|in:0,1',
            'fourth_description' => 'nullable|string',
            // 'fourth_section_button' => 'nullable|json',
            // 'section_5' => 'required|in:0,1',
            'fifth_heading' => 'required|string|max:255',
            // 'toggle_international_property' => 'required|in:0,1',
            // 'fifth_section_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'fifth_section_button' => 'nullable|json',
            // 'section_6' => 'required|in:0,1',
            'sixth_heading' => 'required|string|max:255',
            // 'toggle_development_property' => 'required|in:0,1',
            // 'sixth_section_button' => 'nullable|json',
            // 'section_7' => 'required|in:0,1',
            'seventh_heading' => 'required|string|max:255',
            // 'section_8' => 'required|in:0,1',
            'eighth_heading' => 'required|string|max:255',
            'eighth_description' => 'nullable|string',
            // 'eighth_section_button' => 'nullable|json',
            // 'section_9' => 'required|in:0,1',
            'ninth_heading' => 'required|string|max:255',
            // 'toggle_blog_list' => 'required|in:0,1',
            // 'section_10' => 'required|in:0,1',
            'tenth_heading' => 'required|string|max:255',
            'tenth_description' => 'nullable|string',
            // 'tenth_section_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'tenth_section_button' => 'nullable|json',
        ]);
        // Handle file uploads

        $second_section_button = $this->createButton($request->second_section_button, $request->second_section_button_2) ? 
            [$this->createButton($request->second_section_button, $request->second_section_button_2)] : null;

        $third_section_button = $this->createButton($request->third_section_button, $request->third_section_button_2) ? 
            [$this->createButton($request->third_section_button, $request->third_section_button_2)] : null;

        $fourth_section_button = $this->createButton($request->fourth_section_button, $request->fourth_section_button_2) ? 
            [$this->createButton($request->fourth_section_button, $request->fourth_section_button_2)] : null;

        $fifth_section_button = $this->createButton($request->fifth_section_button, $request->fifth_section_button_2) ? 
            [$this->createButton($request->fifth_section_button, $request->fifth_section_button_2)] : null;

        $sixth_section_button = $this->createButton($request->sixth_section_button, $request->sixth_section_button_2) ? 
            [$this->createButton($request->sixth_section_button, $request->sixth_section_button_2)] : null;

        $eighth_section_button = ($this->createButton($request->eighth_section_button, $request->eighth_section_button_2) || $this->createButton($request->eighth_section_button_3, $request->eighth_section_button_3_2)) ? 
            [
                $this->createButton($request->eighth_section_button, $request->eighth_section_button_2),
                $this->createButton($request->eighth_section_button_3, $request->eighth_section_button_3_2)
            ] : null;

        $tenth_section_button = $this->createButton($request->tenth_section_button, $request->tenth_section_button_2) ? 
            [$this->createButton($request->tenth_section_button, $request->tenth_section_button_2)] : null;
 

        $home = HomePage::orderBy('id','desc')->first();
        if($home){
            $first_section_image = $home->first_section_image;
            $fifth_section_image = $home->fifth_section_image;
            $tenth_section_image = $home->tenth_section_image;
        }else{
            $tenth_section_image = $first_section_image =  $tenth_section_image = "";            
        }

        if(!empty($request->file('first_section_image'))){
            $first_section_image = $imageUploadService->storeImage($request->file('first_section_image'), 'images',1);
        }

        if(!empty($request->file('fifth_section_image'))){
            $fifth_section_image = $imageUploadService->storeImage($request->file('fifth_section_image'), 'images',2);
        }

        if(!empty($request->file('tenth_section_image'))){
            $tenth_section_image = $imageUploadService->storeImage($request->file('tenth_section_image'), 'images',3);
        }
        // var_dump(isset($request->section_1)?$request->section_1:0);die;
        // Create a new HomePage entry
        $homePage = HomePage::create([
            'section_1' => isset($request->section_1)?(string)$request->section_1:'0',
            'first_section_image' => $first_section_image ?? '',
            'list_property' => $validatedData['list_property'] ?? json_encode([]),
            'first_section_heading' => $validatedData['first_section_heading'],
            'section_2' => isset($request->section_2)?(string)$request->section_2: '0',
            'second_heading' => $validatedData['second_heading'],
            'second_description' => $validatedData['second_description'],
            'second_section_button' => json_encode($second_section_button) ?? json_encode([]),
            'section_3' => $request->section_3 ? (string)$request->section_3 : '0',
            'third_section_button' => json_encode($third_section_button) ?? json_encode([]),
            'toggle_featured_property' => $request->input('toggle_featured_property', '1'),
            'section_4' => $request->section_4? (string)$request->section_4: '0',
            'fourth_heading' => $validatedData['fourth_heading'],
            'toggle_private_property' => isset($validatedData['toggle_private_property']) ? $validatedData['toggle_private_property'] : 1,
            'fourth_description' => $validatedData['fourth_description'],
            'fourth_section_button' => json_encode($fourth_section_button) ?? json_encode([]),
            'section_5' => $request->section_5? (string)$request->section_5: '0',
            'fifth_heading' => $validatedData['fifth_heading'],
            'toggle_international_property' => isset($validatedData['toggle_international_property']) ? $validatedData['toggle_international_property']: 1,
            'fifth_section_image' => $fifth_section_image,
            'fifth_section_button' => json_encode($fifth_section_button) ?? json_encode([]),
            'section_6' => $request->section_6? (string)$request->section_6:'0',
            'sixth_heading' => $validatedData['sixth_heading'],
            'toggle_development_property' => isset($validatedData['toggle_development_property'])? $validatedData['toggle_development_property']:1,
            'sixth_section_button' => json_encode($sixth_section_button) ?? json_encode([]),
            'section_7' => $request->section_7?(string)$request->section_7:'0',
            'seventh_heading' => $validatedData['seventh_heading'],
            'section_8' => $request->section_8?(string)$request->section_8:'0',
            'eighth_heading' => $validatedData['eighth_heading'],
            'eighth_description' => $validatedData['eighth_description'],
            'eighth_section_button' => json_encode($eighth_section_button) ?? json_encode([]),
            'section_9' => $request->section_9?(string)$request->section_9:'0',
            'ninth_heading' => $validatedData['ninth_heading'],
            'toggle_blog_list' => isset($validatedData['toggle_blog_list']) ? $validatedData['toggle_blog_list'] : 1,
            'section_10' => $request->section_10?(string)$request->section_10:'0',
            'tenth_heading' => $validatedData['tenth_heading'],
            'tenth_description' => $validatedData['tenth_description'],
            'tenth_section_image' => $tenth_section_image,
            'tenth_section_button' => json_encode($tenth_section_button) ?? json_encode([]),
        ]);

        return redirect()->back()->with('success', 'Home Page data saved successfully!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
