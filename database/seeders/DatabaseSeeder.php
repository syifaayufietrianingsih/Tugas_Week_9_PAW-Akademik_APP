<?php

namespace Database\Seeders;

use App\Models\Materi;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin Sirama',
            'email' => 'admin@admin.telkomuniversity',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Dosen Pengampu',
            'email' => 'dosen@lecturer.telkomuniversity',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);

        $syifa = User::create([
            'name' => 'Syifa',
            'email' => 'syifa@student.telkomuniversity',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
        ]);

        $ayu = User::create([
            'name' => 'Ayu',
            'email' => 'ayu@student.telkomuniversity',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
        ]);

        Materi::create(['judul' => 'Pengantar Middleware', 'deskripsi' => 'Konsep dasar middleware']);
        Materi::create(['judul' => 'Role Based Access Control', 'deskripsi' => 'Pembatasan akses per role']);

        Nilai::create(['user_id' => $syifa->id, 'mata_kuliah' => 'Pemrograman Web', 'nilai' => 85]);
        Nilai::create(['user_id' => $ayu->id, 'mata_kuliah' => 'Pemrograman Web', 'nilai' => 78]);
    }
}