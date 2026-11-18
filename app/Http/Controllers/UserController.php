<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,dosen,mahasiswa',
        ]);

        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect('/users')->with('sukses', 'Pengguna berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'role' => 'required|in:admin,dosen,mahasiswa',
        ]);

        // admin tidak boleh mengubah role akunnya sendiri
        if ($user->id == Auth::id()) {
            $data['role'] = $user->role;
        }

        // password hanya diganti kalau diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect('/users')->with('sukses', 'Data pengguna berhasil diubah');
    }

    public function hapus(User $user)
    {
        if ($user->id == Auth::id()) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri');
        }

        $user->delete();

        return redirect('/users')->with('sukses', 'Pengguna berhasil dihapus');
    }
}