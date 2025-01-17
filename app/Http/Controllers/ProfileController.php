<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Profile;
use App\Services\ImageUploadService;

class ProfileController extends Controller
{
    public function show()
    {
        $profile = auth()->user()->profile;
        return view('profile.show', compact('profile'));
    }

    public function edit()
    {
        $profile = auth()->user()->profile;
        return view('profile.edit', compact('profile'));
    }

    public function update(Request $request,ImageUploadService $imageUploadService)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'avatar' => 'nullable|image',
        ]);
    
        $user = auth()->user();
        
        // Create a profile if it doesn't exist
        $profile = $user->profile ?: $user->profile()->create();
    
        $user->update([
            'name' => $request->first_name." ".$request->last_name,
        ]);


        $data = $request->only(['first_name', 'last_name', 'phone', 'address']);
    
        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->hasFile('avatar') ? $imageUploadService->storeImage($request->file('avatar'), 'public/avatar'): null;
        }

        $profile->update($data);
    
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
    
}

