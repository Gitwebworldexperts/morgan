<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('tags')->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $tags = Tag::all();
        $relatedPosts = Post::all();
        return view('posts.create', compact('tags', 'relatedPosts'));
    }

    public function store(Request $request)
    {
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'tags' => 'array',
        'related_post_id' => 'nullable|exists:posts,id',
        'images' => 'nullable|array', // Make sure 'images' is an array
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each image file
    ]);

     // Generate the slug
     $slug = Str::slug($request->name); // Generate a basic slug
     $slug = $this->generateUniqueSlug($slug);
    // Create the post
    $post = Post::create([
        'name' => $request->name,
        'meta_title' => $request->meta_title,
        'meta_description' => $request->meta_description,
        'description' => $request->description,
        'related_posts' => implode(',', $request->input('related_post_id', [])),
        'slug' => $slug,
        // Add the images string here
        'images' => '', // Default to empty string if no images are uploaded
    ]);

    // Attach tags if they exist
    if ($request->tags) {
        $post->tags()->sync($request->tags);
    }

    $imageNames = []; // Array to hold the image names

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $key => $image) {
            $timestamp = now()->timestamp;
            $extension = $image->getClientOriginalExtension();
            $newFileName = 'image_' . $timestamp . $key . '.' . $extension;
            $image->move('post/', $newFileName);
            
            // Add the new file name to the array
            $imageNames[] = $newFileName;
        }

        // Join the image names with a comma separator
        $imageNamesString = implode(',', $imageNames);

        // Update the post with the images string
        $bold = $post->update([
            'images' => $imageNamesString
        ]);
    }

    // Redirect with success message
    return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

        
    /**
     * Generate a unique slug for the post.
     *
     * @param string $slug
     * @return string
     */
    private function generateUniqueSlug($slug)
    {
        // Check if the slug already exists in the database
        $originalSlug = $slug;
        $counter = 1;

        // Keep appending a number to the slug until it is unique
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function edit(Post $post)
    {
        $tags = Tag::all();
        $relatedPosts = Post::all();
        return view('posts.edit', compact('post', 'tags', 'relatedPosts'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'array',
            'images' => 'nullable|array', // Make sure 'images' is an array
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'related_post_id' => 'nullable|exists:posts,id'
        ]);

        $post->update([
            'name' => $request->name,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'description' => $request->description,
            // 'related_post_id' => $request->related_post_id,
            'related_posts' => implode(',', $request->input('related_post_id', [])),
        ]);


        $imageNames = []; // Array to hold the image names
        if ($request->hasFile('images')) {
            
            foreach ($request->file('images') as $key => $image) {
                $timestamp = now()->timestamp;
                $extension = $image->getClientOriginalExtension();
                $newFileName = 'image_' . $timestamp . $key . '.' . $extension;
                $image->move('post/', $newFileName);
                
                // Add the new file name to the array
                $imageNames[] = $newFileName;
            }
    
            if($post->images){
                $oldImages = explode(',', $post->images);
                $imageNames = array_merge($oldImages, $imageNames);
            }
            // Join the image names with a comma separator
            $imageNamesString = implode(',', $imageNames);
    
            // Update the post with the images string
            $bold = $post->update([
                'images' => $imageNamesString
            ]);
        }
    
            if (empty($request->tags)) {
                // If no tags are selected, detach all tags
                $post->tags()->detach();
            } else {
                // Otherwise, sync the tags (add or remove as necessary)
                $post->tags()->sync($request->tags);
            }
    
        return redirect()->back()->with('success', 'The post has been updated successfully.');

        // return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
