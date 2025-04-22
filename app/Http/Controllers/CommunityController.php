<?php
namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;

use App\Services\ImageUploadService;

class CommunityController extends Controller
{
    // Display a listing of communities
    public function index()
    {
        $communities = Community::all();
        return view('admin.communitie.index', compact('communities'));
    }

    // Show the form for creating a new community
    public function create()
    {
        return view('admin.communitie.create');
    }

    // Store a newly created community in storage
    public function store(Request $request,ImageUploadService $imageUploadService)
    {
        $request->validate([
            'community_name' => 'required|string|max:255',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'section_i_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'section_i_content' => 'required|string',
            'section_ii_content' => 'required|string',
            'button_i_name' => 'required|string',
            // 'button_i_url' => 'required|string',
            'button_ii_name' => 'required|string',
            // 'button_ii_url' => 'required|string',
            'second_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'section_iii_content' => 'required|string',
            'section_iii_button_name' => 'required|string',
            'status' => 'required|in:active,inactive'
        ]);

        $featured_image = $request->hasFile('featured_image') ? $imageUploadService->storeImage($request->file('featured_image'), 'images',46) :"";
        $section_i_image = $request->hasFile('section_i_image') ? $imageUploadService->storeImage($request->file('section_i_image'), 'images',47) :"";
        $second_image = $request->hasFile('second_image') ? $imageUploadService->storeImage($request->file('second_image'), 'images',48) :"";
        $third_image = $request->hasFile('third_image') ? $imageUploadService->storeImage($request->file('third_image'), 'images',49) :"";

        $slug = generateSlug($request->community_name, \App\Models\Community::class);
        Community::create([
            'slug' => $slug,
            'community_name' => $request->community_name,
            'featured_image' => $featured_image,
            'section_i_image' => $section_i_image,
            'section_i_content' => $request->section_i_content,
            'section_ii_content' => $request->section_ii_content,
            'button_i_name' => $request->button_i_name,
            'button_ii_name' => $request->button_ii_name,
            'button_i_url' => $request->button_i_url,
            'button_ii_url' => $request->button_ii_url,
            'second_image' => $second_image,
            'third_image' => $third_image,
            'section_iii_content' => $request->section_iii_content,
            'section_iii_button_name' => $request->section_iii_button_name,
            'status' => $request->status
        ]);

        return redirect()->route('communities.index')->with('success', 'Community created successfully!');
    }

    // Show the form for editing a community
    public function edit($id)
    {
        $community = Community::findOrFail($id);
        return view('admin.communitie.edit', compact('community'));
    }

    // Update the specified community in storage
    public function update(Request $request, $id,ImageUploadService $imageUploadService)
    {
        $request->validate([
            'community_name' => 'required|string|max:255',
            'featured_image' => 'image|mimes:jpeg,png,jpg,gif',
            'section_i_image' => 'image|mimes:jpeg,png,jpg,gif',
            'section_i_content' => 'required|string',
            'section_ii_content' => 'required|string',
            // 'button_i_name' => 'required|string',
            // 'button_ii_name' => 'required|string',
            'second_image' => 'image|mimes:jpeg,png,jpg,gif',
            'section_iii_content' => 'required|string',
            'section_iii_button_name' => 'required|string',
            'status' => 'required|in:active,inactive'
        ]);

        $community = Community::findOrFail($id);

        // Update images only if new ones are uploaded
        if ($request->hasFile('featured_image')) {
            $community->featured_image = $request->hasFile('featured_image') ? $imageUploadService->storeImage($request->file('featured_image'), 'images',99) :"";
        }

        if ($request->hasFile('section_i_image')) {
            $community->section_i_image = $request->hasFile('section_i_image') ? $imageUploadService->storeImage($request->file('section_i_image'), 'images',103) :"";
        }

        if ($request->hasFile('second_image')) {
            $community->second_image = $request->hasFile('second_image') ? $imageUploadService->storeImage($request->file('second_image'), 'images',107) :"";
        }

        if ($request->hasFile('third_image')) {
            $community->third_image = $request->hasFile('third_image') ? $imageUploadService->storeImage($request->file('third_image'), 'images',111) :"";
        }

        
        // $slug = generateSlug($request->community_name, \App\Models\Community::class);
        
        $community->update([
            // 'slug' => $slug,
            'community_name' => $request->community_name,
            'section_i_content' => $request->section_i_content,
            'section_ii_content' => $request->section_ii_content,
            'button_i_name' => $request->button_i_name,
            'button_ii_name' => $request->button_ii_name,
            'button_i_url' => $request->button_i_url,
            'button_ii_url' => $request->button_ii_url,
            'section_iii_content' => $request->section_iii_content,
            'section_iii_button_name' => $request->section_iii_button_name,
            'status' => $request->status
        ]);

        return redirect()->route('communities.index')->with('success', 'Community updated successfully!');
    }

    // Remove the specified community from storage
    public function destroy($id)
    {
        $community = Community::findOrFail($id);
        $community->delete();

        return redirect()->route('communities.index')->with('success', 'Community deleted successfully!');
    }
}
