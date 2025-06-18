<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::firstOrCreate(
                ['user_email' => $googleUser->getEmail()],
                [
                    'user_name'     => $googleUser->getName(),
                    'user_password' => bcrypt('defaultpassword'),
                    'user_phone'    => '',
                ]
            );

            // Login user setelah signup Google
            Auth::login($user);

            // Jika user berhasil dibuat/ditemukan, redirect ke landingpage
            if ($user) {
                return redirect('/')->with('success', 'Sign up with Google successful! Welcome!');
            } else {
                return redirect('/signup')->with('error', 'Failed to sign up with Google.');
            }
        } catch (\Exception $e) {
            return redirect('/signup')->with('error', 'Failed to sign up with Google.');
        }
    }
}
