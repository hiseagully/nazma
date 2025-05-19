<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Tampilkan semua user
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Tampilkan form tambah user
    public function create()
    {
        return view('users.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|max:50',
            'user_email' => 'required|email|max:150|unique:users,user_email',
            'user_phone' => 'nullable|max:15',
            'user_password' => 'required|min:6',
        ]);

        User::create([
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_phone' => $request->user_phone,
            'user_password' => bcrypt($request->user_password),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    // Hapus user
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
}