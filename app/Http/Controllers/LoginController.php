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

        $user = User::where('user_email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email is not registered, please sign up first.');
        }

        if (!Hash::check($request->password, $user->user_password)) {
            return back()->with('error', 'Incorrect password!');
        }

        // Success
        session(['user_id' => $user->user_id]);
        Auth::login($user);
        return redirect('/landingpage')->with('success', 'Login successful! Welcome back.');
    }
}
