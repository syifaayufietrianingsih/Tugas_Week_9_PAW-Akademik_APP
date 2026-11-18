@extends('layout')

@section('isi')
<h2>Data Pengguna</h2>

<table>
    <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>
    @foreach($users as $u)
    <tr>
        <td>{{ $u->name }}</td>
        <td>{{ $u->email }}</td>
        <td><span class="badge badge-{{ $u->role }}">{{ $u->role }}</span></td>
        <td class="aksi">
            <a href="/users/{{ $u->id }}/edit" class="tombol-edit">Edit</a>
            <form method="POST" action="/users/{{ $u->id }}" onsubmit="return confirm('Yakin hapus pengguna ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="tombol-hapus">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<h3>Tambah Pengguna</h3>
<form method="POST" action="/users">
    @csrf
    <input type="text" name="name" placeholder="Nama">
    <input type="text" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <select name="role">
        <option value="admin">admin</option>
        <option value="dosen">dosen</option>
        <option value="mahasiswa">mahasiswa</option>
    </select>
    <button type="submit">Simpan</button>
</form>
@endsection