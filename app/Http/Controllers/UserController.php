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

    // Tampilkan form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edituser', compact('user'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email',
            'user_phone' => 'nullable|string|max:20',
            'role' => 'required|string',
        ]);
        $user->update($data);
        return redirect()->route('admin.userdata')->with('success', 'User updated!');
    }

    // Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.userdata')->with('success', 'User deleted!');
    }

    // Tampilkan semua user untuk admin
    public function adminIndex()
    {
        $users = User::all();
        return view('admin.userdata', [
            'users' => $users,
            'activeMenu' => 'users', // <-- ini penting
        ]);
    }
}