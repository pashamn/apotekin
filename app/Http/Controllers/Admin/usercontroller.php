<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Ubah model ke User
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10); // Ganti variabel ke users
        return view('admin.user.index', compact('users')); // Sesuaikan path ke admin.user.index
    }

    public function create()
    {
        return view('admin.user.create'); // Sesuaikan path ke admin.user.create
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Enkripsi password
        ]);
        return redirect()->route('admin.user')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user')); // Sesuaikan path ke admin.user.edit
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id, // Unik berdasarkan id
            'password' => 'nullable|min:6' // Password opsional
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password, // Perbarui password jika diisi
        ]);
        return redirect()->route('admin.user')
            ->with('success', 'Pengguna berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
