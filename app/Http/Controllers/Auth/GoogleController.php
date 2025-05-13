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

            // Buat pengguna baru atau ambil pengguna yang sudah ada
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => bcrypt('defaultpassword'), // Atur password default
                ]
            );

            // Login pengguna
            Auth::login($user);

            // Arahkan ke halaman setelah login
            return redirect()->route('profile'); // Ganti dengan rute setelah login
        } catch (\Exception $e) {
            return redirect()->route('signup')->with('error', 'Failed to sign up with Google.');
        }
    }
}
