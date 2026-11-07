<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AkunAwalSeeder extends Seeder
{
    public function run(): void
    {
        // Soal 5 (c): password bawaan diganti, 'password123' tidak lagi dipakai.
        // Ganti nilai di bawah ini dengan password kuat milikmu sendiri sebelum dipakai ulang.
        $akun = [
            ['Admin Perpustakaan', 'admin@perpustakaan.test', 'Admin', 'G4nt1P4ssw0rdB4ru!250441100051'],
            ['Petugas Perpustakaan', 'petugas@perpustakaan.test', 'Petugas', 'G4nt1P4ssw0rdB4ru!250441100051'],
        ];

        foreach ($akun as [$nama, $email, $role, $password]) {
            $user = User::firstOrCreate(
                ['email' => $email],
                ['name' => $nama, 'password' => Hash::make($password)]
            );

            $user->syncRoles([$role]);
        }
    }
}
