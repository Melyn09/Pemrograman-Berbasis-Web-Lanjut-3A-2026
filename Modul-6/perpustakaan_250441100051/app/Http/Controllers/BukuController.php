<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->query('q');

        $buku = Buku::with('kategori')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('judul', 'like', '%' . $keyword . '%')
                    ->orWhere('penulis', 'like', '%' . $keyword . '%')
                    ->orWhereHas('kategori', function ($query) use ($keyword) {
                        $query->where('nama', 'like', '%' . $keyword . '%');
                    });
            })
            ->get();

        return view('buku.index', [
            'buku' => $buku,
            'keyword' => $keyword,
            'kategoris' => Kategori::all(),
        ]);
    }

    public function show($id)
    {
        $buku = Buku::with('kategori')->find($id);

        return view('buku.show', [
            'buku' => $buku
        ]);
    }

    // Soal 1 - A2 (rentan): DB::select dengan string digabung manual
    // Soal 2 (b) - diperbaiki: query dengan parameter binding
    public function cari(Request $request)
    {
        $judul = $request->query('judul');

        $hasil = DB::select("SELECT * FROM bukus WHERE judul = '$judul'");

        return response()->json($hasil);
    }

    // Soal 2 (c): penghapusan buku lewat route DELETE + form @csrf @method('DELETE')
    // menggantikan route GET /buku/{buku}/hapus (A3) yang sudah dihapus dari web.php
    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')
            ->with('status', 'Buku berhasil dihapus.');
    }
}
