<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\UserController;
use App\Models\Materi;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/login', [AuthController::class, 'tampilLogin'])->name('login');
Route::post('/login', [AuthController::class, 'prosesLogin']);

// semua user yang sudah login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/dashboard', function () {
        $user = Auth::user();

        $statistik = [];
        $statistik[] = ['Materi', Materi::count()];

        if ($user->role == 'mahasiswa') {
            $nilaiSaya = Nilai::where('user_id', $user->id);
            $statistik[] = ['Nilai Saya', $nilaiSaya->count()];
            $statistik[] = ['Rata-rata', round($nilaiSaya->avg('nilai') ?? 0)];
        } else {
            $statistik[] = ['Mahasiswa', User::where('role', 'mahasiswa')->count()];
            $statistik[] = ['Nilai Tercatat', Nilai::count()];
        }

        return view('dashboard', compact('statistik'));
    });

    Route::get('/materi', [MateriController::class, 'index']);
});

// admin saja
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return 'Halaman Admin';
    });
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'simpan']);
    Route::get('/users/{user}/edit', [UserController::class, 'edit']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'hapus']);
});

// dosen saja
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen', function () {
        return 'Dashboard Dosen';
    });
});

// mahasiswa saja
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa', function () {
        return 'Dashboard Mahasiswa';
    });
});

// admin dan dosen
Route::middleware(['auth', 'role:admin,dosen'])->group(function () {
    Route::get('/kelola-materi', [MateriController::class, 'kelola']);
    Route::post('/kelola-materi', [MateriController::class, 'simpan']);
    Route::get('/kelola-materi/{materi}/edit', [MateriController::class, 'edit']);
    Route::put('/kelola-materi/{materi}', [MateriController::class, 'update']);
    Route::delete('/kelola-materi/{materi}', [MateriController::class, 'hapus']);

    Route::get('/kelola-nilai', [NilaiController::class, 'kelola']);
    Route::post('/kelola-nilai', [NilaiController::class, 'simpan']);
    Route::get('/kelola-nilai/{nilai}/edit', [NilaiController::class, 'edit']);
    Route::put('/kelola-nilai/{nilai}', [NilaiController::class, 'update']);
    Route::delete('/kelola-nilai/{nilai}', [NilaiController::class, 'hapus']);
});

// admin dan mahasiswa
Route::middleware(['auth', 'role:admin,mahasiswa'])->group(function () {
    Route::get('/nilai-saya', [NilaiController::class, 'saya']);
});