<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Pastikan view 'resources/views/login.blade.php' ada
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

    // Use custom credentials for user_email and user_password
    $credentials = [
        'user_email'    => $request->email,
        'user_password' => $request->password,
    ];

    $user = User::where('user_email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->user_password)) {
        Auth::login($user);
        if ($user->role === 'admin') {
            return redirect('/dashboardadmin'); // Ganti dengan route dashboard admin kamu
        } else {
            return redirect('/landingpage'); // Atau route user biasa
        }
    }

    return back()->with('error', 'Email atau password salah!');
    }
    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/landingpage');
}
}

