@extends('layout')

@section('isi')
<div class="sapaan">
    <div class="avatar besar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
    <div>
        <h2>Halo, {{ Auth::user()->name }}</h2>
        <p>
            Selamat datang di Sirama. Anda masuk sebagai
            <span class="badge badge-{{ Auth::user()->role }}">{{ Auth::user()->role }}</span>
        </p>
    </div>
</div>

<div class="statistik">
    @foreach($statistik as $s)
    <div class="stat">
        <span class="angka">{{ $s[1] }}</span>
        <span class="label">{{ $s[0] }}</span>
    </div>
    @endforeach
</div>

<h3>Menu</h3>

<div class="menu-grid">

    <a href="/materi" class="menu">
        <span class="ikon">M</span>
        <div>
            <b>Materi</b>
            <span>Lihat materi perkuliahan</span>
        </div>
    </a>

    @if(Auth::user()->role == 'admin')
    <a href="/users" class="menu">
        <span class="ikon">P</span>
        <div>
            <b>Pengguna</b>
            <span>Kelola akun pengguna</span>
        </div>
    </a>
    @endif

    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'dosen')
    <a href="/kelola-materi" class="menu">
        <span class="ikon">K</span>
        <div>
            <b>Kelola Materi</b>
            <span>Tambah materi baru</span>
        </div>
    </a>

    <a href="/kelola-nilai" class="menu">
        <span class="ikon">N</span>
        <div>
            <b>Kelola Nilai</b>
            <span>Input nilai mahasiswa</span>
        </div>
    </a>
    @endif

    @if(Auth::user()->role == 'admin' || Auth::user()->role == 'mahasiswa')
    <a href="/nilai-saya" class="menu">
        <span class="ikon">S</span>
        <div>
            <b>Nilai Saya</b>
            <span>Lihat nilai pribadi</span>
        </div>
    </a>
    @endif

</div>
@endsection