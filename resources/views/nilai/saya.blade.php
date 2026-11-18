@extends('layout')

@section('isi')
<h2>Nilai Saya</h2>

<table>
    <tr>
        <th>Mata Kuliah</th>
        <th>Nilai</th>
    </tr>
    @foreach($nilai as $n)
    <tr>
        <td>{{ $n->mata_kuliah }}</td>
        <td>{{ $n->nilai }}</td>
    </tr>
    @endforeach
</table>
@endsection