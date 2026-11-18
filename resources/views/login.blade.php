@extends('layout')

@section('isi')
<div class="login-wrap">

    <div class="login-kiri">
        <div class="logo besar">S</div>
        <h1>Sirama</h1>
        <p class="tagline">Sistem Informasi Akademik</p>
    </div>

    <div class="login-kanan">
        <form method="POST" action="/login" class="login-form">
            @csrf
            <h2>Selamat datang</h2>
            <p class="sub">Masuk untuk melanjutkan ke akun Anda.</p>

            @if(session('error'))
                <p class="error">{{ session('error') }}</p>
            @endif
            @if($errors->any())
                <p class="error">{{ $errors->first() }}</p>
            @endif

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@student.telkomuniversity">

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password">

            <button type="submit">Masuk</button>
        </form>
    </div>

</div>
@endsection