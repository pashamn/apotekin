<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    // Menampilkan halaman pengaturan user
    public function showSettingsForm()
    {
        $user = Auth::user(); // Mendapatkan data user yang sedang login
        return view('user.settings', compact('user')); // Arahkan ke file settings.blade.php di folder views/user
    }

    // Proses pembaruan data user
    public function updateSettings(Request $request, string $id)
    {
        $user = User::findOrFail($id); // Mendapatkan user yang sedang login

        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed', // Password opsional
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->alamat = $request->address;

        if ($request->password !== null) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Redirect dengan pesan sukses
        return redirect()->route('my.setting')->with('success', 'User settings updated successfully.');
    }
    public function index()
    {
        $users = User::findOrFail(Auth::user()->id); // Mendapatkan semua pengguna
        return view('setting', compact('users'));
    }

public function edit($id)
{
    $user = User::findOrFail($id); // Mencari pengguna berdasarkan ID
    return view('users.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    // Update data pengguna
    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->password) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('users.index')->with('success', 'User deleted successfully.');
}

}
