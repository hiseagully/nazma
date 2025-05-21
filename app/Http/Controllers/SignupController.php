<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function create()
    {
        // Menampilkan form signup
        return view('user.signup');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,user_email',
            'password' => 'required|string|min:8',
            'phone'    => 'required|string',
        ], [
            'email.unique' => 'This email is already registered.',
            'password.min' => 'Password too short.',
        ]);

        $user = User::create([
            'user_name'     => $request->name,
            'user_email'    => $request->email,
            'user_password' => Hash::make($request->password),
            'user_phone'    => $request->phone,
        ]);

        if ($user) {
            return redirect('/signup')->with('success', 'Sign up successful! Please log in.');
        } else {
            return redirect('/signup')->with('success', 'GAGAL SIMPAN!');
        }
    }
}
