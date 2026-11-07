<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AkunAwalSeeder extends Seeder
{
    public function run(): void
    {
        $akun = [
            ['Admin Perpustakaan', 'admin@gmail.com', 'Admin', 'Admin09876@'],
            ['Petugas Perpustakaan', 'petugas@gmail.com', 'Petugas', '1234Petugas@'],
        ];

        foreach ($akun as [$nama, $email, $role, $password]) {
            $user = User::updateOrCreate(
                ['email' => $email],
                ['name' => $nama, 'password' => Hash::make($password)]
            );

            $user->syncRoles([$role]);
        }
    }
}
