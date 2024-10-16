<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // Create this view
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            // Check if user is admin
            if (Gate::allows('isAdmin')) { 
                return redirect()->intended('admin'); 
            }
            Auth::logout();
            return redirect()->back()->withErrors(['email' => 'You are not authorized to access this area.']);
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }
}
