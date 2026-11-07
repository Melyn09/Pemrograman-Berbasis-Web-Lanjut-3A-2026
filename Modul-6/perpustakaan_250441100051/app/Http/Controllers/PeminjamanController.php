<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\Gate;

class PeminjamanController extends Controller
{
    public function show($id)
    {
        $peminjaman = Peminjaman::with(['anggota', 'buku'])->findOrFail($id);

        // Soal 4: Memeriksa hak akses pengguna sebelum menampilkan detail peminjaman.
        Gate::authorize('view', $peminjaman);

        return view('peminjaman.show', compact('peminjaman'));
    }
}



