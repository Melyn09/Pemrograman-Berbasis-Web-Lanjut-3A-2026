<?php

namespace App\Policies;

use App\Models\Peminjaman;
use App\Models\User;

class PeminjamanPolicy
{
    // Soal 4: Membatasi akses detail peminjaman berdasarkan role dan kepemilikan data.
    public function view(User $user, Peminjaman $peminjaman): bool
    {
        if ($user->hasRole('Admin') || $user->hasRole('Petugas')) {
            return true;
        }

        return $user->hasRole('Siswa')
            && $user->anggota?->id == $peminjaman->anggota_id;
    }
}
