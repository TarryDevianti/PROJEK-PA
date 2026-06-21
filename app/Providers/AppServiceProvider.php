<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema; // Tambahkan ini
use App\Models\Faq;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
  public function boot(): void
{
    // Gunakan DB::table agar lebih fleksibel, 
    // sesuaikan 'nama_tabel_di_db' dengan nama tabel yang muncul di panel Admin
    $faqs = collect();

    try {
        // GANTI 'nama_tabel_di_db' dengan nama tabel asli yang menyimpan data FAQ Anda
        // Berdasarkan menu admin, mungkin namanya 'help_centers', 'help_center', atau 'pusat_bantuan'
        if (\Illuminate\Support\Facades\Schema::hasTable('help_centers')) {
            $faqs = \DB::table('help_centers')->get();
        } elseif (\Illuminate\Support\Facades\Schema::hasTable('pusat_bantuan')) {
            $faqs = \DB::table('pusat_bantuan')->get();
        }
    } catch (\Exception $e) {
        // Biarkan kosong jika gagal
    }

    \Illuminate\Support\Facades\View::share('faqs', $faqs);
}
}