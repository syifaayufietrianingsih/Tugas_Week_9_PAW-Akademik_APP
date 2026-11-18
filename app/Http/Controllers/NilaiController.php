<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function kelola()
    {
        $nilai = Nilai::with('user')->get();
        $mahasiswa = User::where('role', 'mahasiswa')->get();
        return view('nilai.kelola', compact('nilai', 'mahasiswa'));
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'mata_kuliah' => 'required',
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        Nilai::create($data);

        return redirect('/kelola-nilai')->with('sukses', 'Nilai berhasil disimpan');
    }

    public function edit(Nilai $nilai)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->get();
        return view('nilai.edit', compact('nilai', 'mahasiswa'));
    }

    public function update(Request $request, Nilai $nilai)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'mata_kuliah' => 'required',
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        $nilai->update($data);

        return redirect('/kelola-nilai')->with('sukses', 'Nilai berhasil diubah');
    }

    public function hapus(Nilai $nilai)
    {
        $nilai->delete();

        return redirect('/kelola-nilai')->with('sukses', 'Nilai berhasil dihapus');
    }

    // hanya nilai milik user yang sedang login
    public function saya()
    {
        $nilai = Nilai::where('user_id', Auth::id())->get();
        return view('nilai.saya', compact('nilai'));
    }
}