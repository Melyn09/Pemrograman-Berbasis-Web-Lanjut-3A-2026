<?php

namespace App\Policies;

use App\Models\Peminjaman;
use App\Models\User;

class PeminjamanPolicy
{
    /**
     * Soal 4: Admin dan Petugas boleh melihat semua peminjaman.
     * Siswa hanya boleh melihat peminjaman miliknya sendiri
     * (dicocokkan lewat relasi User -> Anggota berdasarkan email).
     */
    public function view(User $user, Peminjaman $peminjaman): bool
    {
        if ($user->hasAnyRole(['Admin', 'Petugas'])) {
            return true;
        }

        return $user->anggota !== null
            && $user->anggota->id === $peminjaman->anggota_id;
    }
}
