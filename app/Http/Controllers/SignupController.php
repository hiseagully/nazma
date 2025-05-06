<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function create()
    {
        // Menampilkan form signup
        return view('signup');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:15',
        ]);

        // Proses pendaftaran (misalnya simpan ke database)
        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => bcrypt($request->password),
        //     'phone' => $request->phone,
        // ]);

        // Redirect atau beri response
        return redirect()->route('signup')->with('success', 'Sign up successful!');
    }
}
