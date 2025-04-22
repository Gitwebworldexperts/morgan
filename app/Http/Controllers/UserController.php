<?php

namespace App\Http\Controllers;

use App\Models\User;
use  Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\ImageUploadService;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')
        ->orderBy('id', 'desc')
        ->get();
    
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request,ImageUploadService $imageUploadService)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|max:2048',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $profile = $user->profile ?: $user->profile()->create();
        
        $fullName = $request->name;
        $nameParts = explode(' ', trim($fullName), 2);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';



        $data = $request->only(['phone', 'address']);
        $data['first_name'] = $firstName;
        $data['last_name'] = $lastName;
    
        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->hasFile('avatar') ? $imageUploadService->storeImage($request->file('avatar'), 'public/avatar'): null;
        }

        // Filter out null values to avoid overwriting with null
        $data = array_filter($data, fn($value) => !is_null($value) && $value !== '');


        $profile->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }
    public function edit(User $user)
    {
        $profile = $user->profile; // Assuming the relationship is defined as $user->profile
        return view('admin.users.edit', compact('user', 'profile'));
    }
    
    public function update(Request $request, User $user, ImageUploadService $imageUploadService)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'avatar' => 'nullable|max:2048',
        ]);
    
        // Update user basic details
        $user->name = $request->name;
        $user->email = $request->email;
    
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
    
        // Update or create the user's profile
        $profile = $user->profile ?: $user->profile()->create();
    
        $fullName = $request->name;
        $nameParts = explode(' ', trim($fullName), 2);
        $firstName = $nameParts[0] ?? '';
        $lastName = $nameParts[1] ?? '';
    
        $data = $request->only(['phone', 'address']);
        $data['first_name'] = $firstName;
        $data['last_name'] = $lastName;
    
        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $imageUploadService->storeImage($request->file('avatar'), 'public/avatar');
        }
    
        // Filter out null values
        $data = array_filter($data, fn($value) => !is_null($value) && $value !== '');
    
        $profile->update($data);
    
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
    

    public function destroy(User $user)
    {
        $authId = Auth::user()->id;
        if($user->id != $authId){
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
        }else{
            return redirect()->route('admin.users.index')->with('error', 'The same user cannot delete themselves');
        }        
    }

    public function toggleStatus($user)
    {
        $userDetails = User::find($user);
        if ($userDetails->is_active === 0) {
            $userDetails->is_active =  1;
            $userDetails->save();

            return redirect()->route('admin.users.index')->with('success', "User activated successfully.");
        } elseif ($userDetails->is_active === 1) {
            $userDetails->is_active =  0;
            $userDetails->save();
            return redirect()->route('admin.users.index')->with('success', "User deactivated successfully.");
        }else{
            return redirect()->route('admin.users.index')->with('error', 'The same user cannot delete themselves');
        }
    }

    public function exportUsersToCSV()
{
    $fileName = 'users.csv';
    $users = \App\Models\User::all(); // Replace with your model as needed

    $headers = [
        "Content-type"        => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    ];

    // Your column headers
    $columns = ['ID', 'Name', 'Email', 'Created At'];

    $callback = function() use($users, $columns) {
        $file = fopen('php://output', 'w');

        // 🔥 Title Row
        fputcsv($file, ['User Export Report - Generated on ' . now()->format('Y-m-d H:i:s')]);
        
        // ✅ Empty row for spacing (optional)
        fputcsv($file, []);
        
        // 🧩 Column headers
        fputcsv($file, $columns);

        // 🔁 Data rows
        foreach ($users as $user) {
            fputcsv($file, [
                $user->id,
                $user->name,
                $user->email,
                $user->created_at,
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}


    public function exportUsersToCSV_OLD()
    {
        $fileName = 'users.csv';
        $users = \App\Models\User::all(); // You can adjust the model accordingly
    
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];
    
        $columns = ['ID', 'Name', 'Email', 'Created At'];
    
        $callback = function() use($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
    
            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->created_at,
                ]);
            }
    
            fclose($file);
        };
    
        return response()->stream($callback, 200, $headers);
    }

}
