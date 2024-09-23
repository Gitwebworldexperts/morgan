<?php
namespace App\Http\Controllers;

use App\Models\HeaderSections;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HeaderSectionController extends Controller
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
    public function index()
    {
        $headerSections = HeaderSections::first();
        return view('admin.index', compact('headerSections'));
     }

    public function create()
    {
        return view('header_sections.create');
    }

    public function store(Request $request)
    {
        $data = $request->all(); // or any data array you are validating
        $validator = Validator::make($data, [
            // 'logo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'logo' => 'image|mimes:jpg,jpeg,png',
            'nav_name' => 'required|array',
            'nav_url' => 'required|array',
        ]);
        // Manually adding errors if the array is empty
        if (isset($data['nav_name']) && !$data['nav_name'][0]) {
            $validator->errors()->add('nav_name', 'The nav name should not be empty.');
            return redirect()->back()->withErrors($validator)->withInput();
        }   
        if (isset($data['nav_url']) && !$data['nav_url'][0]) {
            $validator->errors()->add('nav_url', 'The nav url array should not be empty.');                        
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $actions  = $data['nav_name'];
        $urls = $data['nav_url'];
        // Combine the arrays into an associative array
        $url_json = $combined = [];
        foreach ($urls as $index => $url) {
            $url_json[$url] = $actions[$index];
        }


        $new_actions  = $data['new_nav_name'];
        $new_urls = $data['new_nav_url'];
        // Combine the arrays into an associative array
        $new_url_json = $new_combined = [];
        foreach ($new_urls as $index => $url) {
            $new_url_json[$url] = $new_actions[$index];
        }


        $buttons = ['first_button_name'=>$data['first_button_name'],'first_button_url'=>$data['first_button_url'],'second_button_name'=>$data['second_button_name'],'second_button_url'=> $data['second_button_url']];

        $combined = ['urls'=>$url_json,'buttons'=>$buttons,'dropdown_urls'=>$new_url_json];        
        // Convert to JSON

        $json = json_encode($combined, JSON_PRETTY_PRINT);
        // Retrieve the first record of HeaderSections, if any
        $headerSection = HeaderSections::first();

        // If no existing record, create a new instance
        if (!$headerSection) {
            $headerSection = new HeaderSections();
        }

        // Handle logo file upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            // Generate a new file name
            $timestamp = now()->timestamp;
            $extension = $logo->getClientOriginalExtension();
            $newFileName = 'logo_' . $timestamp . '.' . $extension;
            // Define the path where the logo will be moved
            $logoPath = 'logos/' . $newFileName;
            // Move the logo to the public directory
            $logo->move(public_path('logos'), $newFileName);
            // Save the logo path in the database
            $headerSection->logo_url = $logoPath;
        }

        // Save or update navigation links
        $headerSection->navigation_links = $json;

        // Save the record
        $headerSection->save();

        return redirect()->route('header_sections.index');
    }

    public function edit(HeaderSection $headerSection)
    {
        return view('header_sections.edit', compact('headerSection'));
    }

    public function update(Request $request, HeaderSection $headerSection)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'navigation_links' => 'required|array',
        ]);

        if ($request->hasFile('logo')) {
            // Remove old logo if exists
            if ($headerSection->logo_url) {
                Storage::disk('public')->delete($headerSection->logo_url);
            }

            $logoPath = $request->file('logo')->store('logos', 'public');
            $headerSection->logo_url = $logoPath;
        }

        $headerSection->navigation_links = $request->input('navigation_links');
        $headerSection->save();

        return redirect()->route('header_sections.index');
    }

    public function destroy(HeaderSection $headerSection)
    {
        if ($headerSection->logo_url) {
            Storage::disk('public')->delete($headerSection->logo_url);
        }

        $headerSection->delete();
        return redirect()->route('header_sections.index');
    }
}
