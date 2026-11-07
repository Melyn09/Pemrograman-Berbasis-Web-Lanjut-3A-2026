<?php

namespace App\Providers;

use App\Models\Peminjaman;
use App\Policies\PeminjamanPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Soal 3: Gate terpusat untuk pengelolaan buku.
        // Hanya role Admin dan Petugas yang diizinkan.
        Gate::define('kelola-buku', function ($user) {
            return $user->hasAnyRole(['Admin', 'Petugas']);
        });

        // Soal 4: daftarkan PeminjamanPolicy secara eksplisit.
        Gate::policy(Peminjaman::class, PeminjamanPolicy::class);
    }
}
