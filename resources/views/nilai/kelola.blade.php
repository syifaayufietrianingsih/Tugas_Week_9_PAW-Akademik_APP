@extends('layout')

@section('isi')
<h2>Kelola Nilai</h2>

<table>
    <tr>
        <th>Mahasiswa</th>
        <th>Mata Kuliah</th>
        <th>Nilai</th>
        <th>Aksi</th>
    </tr>
    @foreach($nilai as $n)
    <tr>
        <td>{{ $n->user->name }}</td>
        <td>{{ $n->mata_kuliah }}</td>
        <td>{{ $n->nilai }}</td>
        <td class="aksi">
            <a href="/kelola-nilai/{{ $n->id }}/edit" class="tombol-edit">Edit</a>
            <form method="POST" action="/kelola-nilai/{{ $n->id }}" onsubmit="return confirm('Yakin hapus nilai ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="tombol-hapus">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<h3>Input Nilai</h3>
<form method="POST" action="/kelola-nilai">
    @csrf
    <select name="user_id">
        @foreach($mahasiswa as $m)
            <option value="{{ $m->id }}">{{ $m->name }}</option>
        @endforeach
    </select>
    <input type="text" name="mata_kuliah" placeholder="Mata kuliah">
    <input type="number" name="nilai" placeholder="Nilai 0-100">
    <button type="submit">Simpan</button>
</form>
@endsection