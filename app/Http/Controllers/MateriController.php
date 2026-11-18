<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    // semua yang login boleh lihat
    public function index()
    {
        $materi = Materi::all();
        $kelola = false;
        return view('materi.index', compact('materi', 'kelola'));
    }

    // khusus admin dan dosen
    public function kelola()
    {
        $materi = Materi::all();
        $kelola = true;
        return view('materi.index', compact('materi', 'kelola'));
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'nullable',
        ]);

        Materi::create($data);

        return redirect('/kelola-materi')->with('sukses', 'Materi berhasil ditambahkan');
    }

    public function edit(Materi $materi)
    {
        return view('materi.edit', compact('materi'));
    }

    public function update(Request $request, Materi $materi)
    {
        $data = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $materi->update($data);

        return redirect('/kelola-materi')->with('sukses', 'Materi berhasil diubah');
    }

    public function hapus(Materi $materi)
    {
        $materi->delete();

        return redirect('/kelola-materi')->with('sukses', 'Materi berhasil dihapus');
    }
}