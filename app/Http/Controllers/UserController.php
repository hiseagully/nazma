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

    // Update user (admin)
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

    // Update profile user (khusus profile sendiri)
    public function updateProfile(Request $request)
    {
        $request->validate([
            'user_name' => 'required|max:50',
            'user_phone' => 'nullable|max:15',
            'user_password' => 'nullable|min:6',
            'district_code' => 'required',
            'district_name' => 'required',
            'full_address' => 'required',
        ]);

        $user = auth()->user();
        \Log::info('User before update', $user ? $user->toArray() : []);
        \Log::info('Request data', $request->only(['user_name','user_phone','district_code','district_name','full_address']));

        $user->user_name = $request->user_name;
        $user->user_phone = $request->user_phone;
        $user->district_code = $request->district_code;
        $user->district_name = $request->district_name;
        $user->full_address = $request->full_address;

        if ($request->filled('user_password')) {
            $user->user_password = bcrypt($request->user_password);
        }

        $user->save();
        \Log::info('User after save', $user ? $user->toArray() : []);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    // Tampilkan form edit profile user
    public function editProfile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }
}