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
            'email'    => 'required|email|unique:users,user_email',
            'name'     => 'required|string|max:50',
            'password' => 'required|string|min:6',
            'phone'    => 'required|string|max:15',
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
