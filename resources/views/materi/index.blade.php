@extends('layout')

@section('isi')
<h2>Materi</h2>

<table>
    <tr>
        <th>Judul</th>
        <th>Deskripsi</th>
        @if($kelola)
            <th>Aksi</th>
        @endif
    </tr>
    @foreach($materi as $m)
    <tr>
        <td>{{ $m->judul }}</td>
        <td>{{ $m->deskripsi }}</td>
        @if($kelola)
        <td class="aksi">
            <a href="/kelola-materi/{{ $m->id }}/edit" class="tombol-edit">Edit</a>
            <form method="POST" action="/kelola-materi/{{ $m->id }}" onsubmit="return confirm('Yakin hapus materi ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="tombol-hapus">Hapus</button>
            </form>
        </td>
        @endif
    </tr>
    @endforeach
</table>

@if($kelola)
<h3>Tambah Materi</h3>
<form method="POST" action="/kelola-materi">
    @csrf
    <input type="text" name="judul" placeholder="Judul">
    <textarea name="deskripsi" placeholder="Deskripsi"></textarea>
    <button type="submit">Simpan</button>
</form>
@endif
@endsection