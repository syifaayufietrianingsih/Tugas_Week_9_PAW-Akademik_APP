<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sirama</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@auth
<div class="kepala">
    <header class="atas">
        <a href="/dashboard" class="brand">
            <span class="logo">S</span>
            <span>Sirama</span>
        </a>

        <nav>
            <a href="/dashboard" class="{{ request()->is('dashboard') ? 'aktif' : '' }}">Dashboard</a>
            <a href="/materi" class="{{ request()->is('materi') ? 'aktif' : '' }}">Materi</a>

            @if(Auth::user()->role == 'admin')
                <a href="/users" class="{{ request()->is('users') ? 'aktif' : '' }}">Pengguna</a>
            @endif

            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'dosen')
                <a href="/kelola-materi" class="{{ request()->is('kelola-materi') ? 'aktif' : '' }}">Kelola Materi</a>
                <a href="/kelola-nilai" class="{{ request()->is('kelola-nilai') ? 'aktif' : '' }}">Kelola Nilai</a>
            @endif

            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'mahasiswa')
                <a href="/nilai-saya" class="{{ request()->is('nilai-saya') ? 'aktif' : '' }}">Nilai Saya</a>
            @endif
        </nav>

        <div class="akun">
            <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div class="akun-info">
                <span class="nama">{{ Auth::user()->name }}</span>
                <span class="peran">{{ Auth::user()->role }}</span>
            </div>
            <form method="POST" action="/logout">
                @csrf
                <button type="submit">Keluar</button>
            </form>
        </div>
    </header>
</div>

<main class="isi">
    @if(session('sukses'))
        <p class="sukses">{{ session('sukses') }}</p>
    @endif
    @if(session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif
    @if($errors->any())
        <p class="error">{{ $errors->first() }}</p>
    @endif

    @yield('isi')
</main>

<footer class="kaki">
    &copy; 2026 Sirama &middot; Sistem Informasi Akademik
</footer>
@else
    @yield('isi')
@endauth

</body>
</html>