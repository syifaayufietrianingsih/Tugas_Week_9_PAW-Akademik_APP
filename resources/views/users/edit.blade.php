@extends('layout')

@section('isi')
<h2>Edit Pengguna</h2>

<form method="POST" action="/users/{{ $user->id }}">
    @csrf
    @method('PUT')

    <label>Nama</label>
    <input type="text" name="name" value="{{ old('name', $user->name) }}">

    <label>Email</label>
    <input type="text" name="email" value="{{ old('email', $user->email) }}">

    <label>Password baru (kosongkan jika tidak diganti)</label>
    <input type="password" name="password">

    <label>Role</label>
    <select name="role">
        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>admin</option>
        <option value="dosen" {{ $user->role == 'dosen' ? 'selected' : '' }}>dosen</option>
        <option value="mahasiswa" {{ $user->role == 'mahasiswa' ? 'selected' : '' }}>mahasiswa</option>
    </select>

    <button type="submit">Simpan Perubahan</button>
    <a href="/users" class="batal">Batal</a>
</form>
@endsection