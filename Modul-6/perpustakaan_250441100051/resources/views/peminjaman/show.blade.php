<x-app-layout>
    <section class="detail-section">
        <div class="detail-card">
            <h2>Detail Peminjaman #{{ $peminjaman->id }}</h2>

            <div class="detail-info">
                <p><strong>Anggota</strong><span>{{ $peminjaman->anggota->nama ?? '-' }}</span></p>
                <p><strong>Buku</strong><span>{{ $peminjaman->buku->judul ?? '-' }}</span></p>
                <p><strong>Tanggal Pinjam</strong><span>{{ $peminjaman->tanggal_pinjam }}</span></p>
                <p><strong>Tanggal Kembali</strong><span>{{ $peminjaman->tanggal_kembali }}</span></p>
                <p><strong>Status</strong><span>{{ $peminjaman->status }}</span></p>
            </div>

            <a href="{{ route('buku.index') }}" class="primary-button">Kembali</a>
        </div>
    </section>
</x-app-layout>
