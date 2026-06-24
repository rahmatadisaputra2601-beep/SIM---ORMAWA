<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ormawa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. INPUT DATA ORMAWA
        $bem = Ormawa::create(['nama_ormawa' => 'Badan Eksekutif Mahasiswa', 'singkatan' => 'BEM']);
        $dpm = Ormawa::create(['nama_ormawa' => 'Dewan Perwakilan Mahasiswa', 'singkatan' => 'DPM']);
        
        // Ormawa Baru Request Lu:
        $hma = Ormawa::create(['nama_ormawa' => 'Himpunan Mahasiswa Akuntansi', 'singkatan' => 'HMA']);
        $hmm = Ormawa::create(['nama_ormawa' => 'Himpunan Mahasiswa Manajemen', 'singkatan' => 'HMM']);
        $mahadika = Ormawa::create(['nama_ormawa' => 'Mahasiswa Bidikmisi dan KIP-K', 'singkatan' => 'MAHADIKA']);
        $duta = Ormawa::create(['nama_ormawa' => 'Duta Muda Tambara', 'singkatan' => 'DUTA']);

        // 2. INPUT DATA USER (AKUN LOGIN)
        // Akun Lama
        User::create([
            'name' => 'Bendahara BEM',
            'email' => 'bendahara@bem.com',
            'password' => Hash::make('password123'),
            'role' => 'bendahara',
            'ormawa_id' => $bem->id,
        ]);

        User::create([
            'name' => 'Auditor DPM',
            'email' => 'auditor@dpm.com',
            'password' => Hash::make('password123'),
            'role' => 'dpm',
            'ormawa_id' => $dpm->id,
        ]);

        // Akun Baru untuk Ormawa Baru:
        User::create([
            'name' => 'Bendahara HMA',
            'email' => 'bendahara@hma.com',
            'password' => Hash::make('password123'),
            'role' => 'bendahara',
            'ormawa_id' => $hma->id,
        ]);

        User::create([
            'name' => 'Bendahara HMM',
            'email' => 'bendahara@hmm.com',
            'password' => Hash::make('password123'),
            'role' => 'bendahara',
            'ormawa_id' => $hmm->id,
        ]);

        User::create([
            'name' => 'Bendahara MAHADIKA',
            'email' => 'bendahara@mahadika.com',
            'password' => Hash::make('password123'),
            'role' => 'bendahara',
            'ormawa_id' => $mahadika->id,
        ]);

        User::create([
            'name' => 'Bendahara DUTA',
            'email' => 'bendahara@duta.com',
            'password' => Hash::make('password123'),
            'role' => 'bendahara',
            'ormawa_id' => $duta->id,
        ]);
    }
}