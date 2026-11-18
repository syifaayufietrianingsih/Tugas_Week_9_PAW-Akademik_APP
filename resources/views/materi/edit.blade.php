@extends('layout')

@section('isi')
<h2>Edit Materi</h2>

<form method="POST" action="/kelola-materi/{{ $materi->id }}">
    @csrf
    @method('PUT')

    <label>Judul</label>
    <input type="text" name="judul" value="{{ old('judul', $materi->judul) }}">

    <label>Deskripsi</label>
    <textarea name="deskripsi">{{ old('deskripsi', $materi->deskripsi) }}</textarea>

    <button type="submit">Simpan Perubahan</button>
    <a href="/kelola-materi" class="batal">Batal</a>
</form>
@endsection