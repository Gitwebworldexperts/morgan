<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle(): Response
    {
        $response = Socialite::driver('google')->redirect();
    
        // Modify response headers to include 'X-Robots-Tag'
        $response->headers->set('X-Robots-Tag', 'noindex, nofollow');
    
        return $response;
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $googleUser->email)->first();
        if(!$user)
        {
            $user = User::create(['name' => $googleUser->name, 'email' => $googleUser->email, 'password' => \Hash::make(rand(100000,999999))]);
        }

        Auth::login($user);
        return redirect()->route('home');
    }
}
