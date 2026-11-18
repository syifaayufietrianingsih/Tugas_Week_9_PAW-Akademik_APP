@extends('layout')

@section('isi')
<h2>Edit Nilai</h2>

<form method="POST" action="/kelola-nilai/{{ $nilai->id }}">
    @csrf
    @method('PUT')

    <label>Mahasiswa</label>
    <select name="user_id">
        @foreach($mahasiswa as $m)
            <option value="{{ $m->id }}" {{ $nilai->user_id == $m->id ? 'selected' : '' }}>{{ $m->name }}</option>
        @endforeach
    </select>

    <label>Mata Kuliah</label>
    <input type="text" name="mata_kuliah" value="{{ old('mata_kuliah', $nilai->mata_kuliah) }}">

    <label>Nilai (0-100)</label>
    <input type="number" name="nilai" value="{{ old('nilai', $nilai->nilai) }}">

    <button type="submit">Simpan Perubahan</button>
    <a href="/kelola-nilai" class="batal">Batal</a>
</form>
@endsection