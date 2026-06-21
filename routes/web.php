<?php

use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\UkmController;
use App\Http\Controllers\UkmPublicController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\HelpCenterController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AdminPengurusController;
use App\Http\Controllers\Admin\AdminPengurusAnggotaController;
use App\Http\Controllers\Admin\AdminPengurusCalonController;
use App\Http\Controllers\Admin\AdminPengurusGaleriController;
use App\Http\Controllers\Admin\AdminPengurusKegiatanController;
use App\Http\Controllers\Admin\AdminPengurusJadwalController;
use App\Http\Controllers\Admin\AdminPengurusKontakController;
use App\Http\Controllers\Admin\DashboardSuperAdminController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// ======================================================
// LOGOUT
// ======================================================

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');


// ======================================================
// BERANDA
// ======================================================

Route::get('/', function () {

    try {

        if (Schema::hasTable('help_centers')) {

            $faqs = DB::table('help_centers')->get();

        } elseif (Schema::hasTable('help_center')) {

            $faqs = DB::table('help_center')->get();

        } else {

            $faqs = DB::table('pusat_bantuan')->get();
        }

    } catch (\Exception $e) {

        $faqs = collect();
    }

    return view('welcome', compact('faqs'));

})->name('beranda');


// ======================================================
// DETAIL UKM
// ======================================================
Route::get(
    '/ukm/{slug}/{tab?}',
    [UkmPublicController::class, 'show']
)->name('ukm.detail-publik');


// ======================================================
// AUTH
// ======================================================

Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'index'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [LoginController::class, 'showRegisterForm'])
        ->name('register');

    Route::post('/register', [LoginController::class, 'register']);

});


// ======================================================
// PANEL MAHASISWA
// ======================================================

Route::middleware('auth')->group(function () {

    // FORM PENDAFTARAN UKM
    Route::get('/pendaftaran/isi/{ukm_slug}', [PendaftaranController::class, 'showForm'])
        ->name('mahasiswa.pendaftaran.isi');

    // SIMPAN FORM
    Route::post('/pendaftaran/simpan', [PendaftaranController::class, 'storeForm'])
        ->name('mahasiswa.pendaftaran.simpan');

    // DASHBOARD USER
    Route::get('/dashboard', [PendaftaranController::class, 'dashboard'])
        ->name('dashboard');

});


// ======================================================
// PANEL ADMIN
// ======================================================

Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {

    // DASHBOARD
    Route::get('/', [UkmController::class, 'index'])
        ->name('admin.dashboard');

Route::get('/dashboard-super-admin', [DashboardSuperAdminController::class, 'index'])
    ->name('dashboard.super.admin');
    
    // ======================================================
    // UKM
    // ======================================================

    Route::resource('manajemen-ukm', UkmController::class);

    // ======================================================
    // PENGURUS
    // ======================================================

    Route::resource('pengurus', PengurusController::class)->names([
        'index' => 'pengurus.admin',
        'create' => 'pengurus.create',
        'store' => 'pengurus.store',
        'edit' => 'pengurus.edit',
        'update' => 'pengurus.update',
        'destroy' => 'pengurus.destroy',
    ]);

    // ======================================================
    // PENDAFTARAN
    // ======================================================

    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])
        ->name('pendaftaran.admin');

    Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'show'])
        ->name('pendaftaran.show');

    Route::post('/pendaftaran/terima/{id}', [PendaftaranController::class, 'terimaAnggota'])
        ->name('pendaftaran.terima');

    Route::delete('/pendaftaran/{id}', [PendaftaranController::class, 'destroy'])
        ->name('pendaftaran.destroy');

    // ======================================================
    // KEGIATAN
    // ======================================================
        Route::get('/ukm/{slug}/kegiatan', [KegiatanController::class, 'index'])
            ->name('kegiatan.ukm');

        Route::get('/ukm/{slug}/kegiatan/{id}', [KegiatanController::class, 'show'])
            ->name('kegiatan.detail');

// ======================================================
// ANGGOTA UKM
// ======================================================

Route::get('/ukm/{ukm_id}/anggota', [AnggotaController::class, 'index'])
    ->name('admin.ukm.anggota');

Route::get('/ukm/{id}/anggota/profil', [AnggotaController::class, 'show'])
    ->name('admin.ukm.anggota.profil');

    // ======================================================
    // AKUN
    // ======================================================

    Route::resource('manajemen-akun', AccountController::class);

    Route::post('/manajemen-akun/{id}/reset', [AccountController::class, 'resetPassword'])
        ->name('manajemen-akun.reset');

    Route::post('/manajemen-akun/{id}/blokir', [AccountController::class, 'blokir'])
        ->name('manajemen-akun.blokir');

    // ======================================================
    // HELP CENTER
    // ======================================================

    Route::resource('pusat-bantuan', HelpCenterController::class);

});


// ======================================================
// PANEL ADMIN PENGURUS
// ======================================================

Route::prefix('admin-pengurus')
    ->middleware(['auth'])
    ->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [AdminPengurusController::class, 'dashboard'])
        ->name('admin-pengurus.dashboard');

    // PROFIL
    Route::get('/profil', [AdminPengurusController::class, 'profil'])
        ->name('admin-pengurus.profil');
  
    // ======================================================
    // KEGIATAN
    // ======================================================

    Route::get('/kegiatan', [AdminPengurusKegiatanController::class, 'index'])
        ->name('admin-pengurus.kegiatan');

    Route::get('/kegiatan/create', [AdminPengurusKegiatanController::class, 'create'])
        ->name('admin-pengurus.kegiatan.create');

    Route::post('/kegiatan/store', [AdminPengurusKegiatanController::class, 'store'])
        ->name('admin-pengurus.kegiatan.store');

    Route::get('/kegiatan/{id}/show', [AdminPengurusKegiatanController::class, 'show'])
        ->name('admin-pengurus.kegiatan.show');

    Route::get('/kegiatan/{id}/edit', [AdminPengurusKegiatanController::class, 'edit'])
        ->name('admin-pengurus.kegiatan.edit');

    Route::put('/kegiatan/{id}/update', [AdminPengurusKegiatanController::class, 'update'])
        ->name('admin-pengurus.kegiatan.update');

    Route::delete('/kegiatan/{id}/delete', [AdminPengurusKegiatanController::class, 'destroy'])
        ->name('admin-pengurus.kegiatan.delete');


    // ======================================================
    // DATA ANGGOTA
    // ======================================================

    Route::get('/anggota', [AdminPengurusAnggotaController::class, 'index'])
        ->name('admin-pengurus.anggota');

    Route::get('/anggota/{id}', [AdminPengurusAnggotaController::class, 'show'])
        ->name('admin-pengurus.anggota.show');

    Route::get('/anggota/{id}/edit', [AdminPengurusAnggotaController::class, 'edit'])
        ->name('admin-pengurus.anggota.edit');

    Route::put('/anggota/{id}', [AdminPengurusAnggotaController::class, 'update'])
        ->name('admin-pengurus.anggota.update');

    Route::delete('/anggota/{id}', [AdminPengurusAnggotaController::class, 'destroy'])
        ->name('admin-pengurus.anggota.destroy');


    // ======================================================
    // CALON ANGGOTA
    // ======================================================

    Route::get('/calon-anggota', [AdminPengurusCalonController::class, 'index'])
        ->name('admin-pengurus.calon-anggota');

    Route::get('/calon-anggota/{id}', [AdminPengurusCalonController::class, 'show'])
        ->name('admin-pengurus.calon.show');

    Route::put('/calon-anggota/{id}/terima', [AdminPengurusCalonController::class, 'terima'])
        ->name('admin-pengurus.calon.terima');

    Route::put('/calon-anggota/{id}/tolak', [AdminPengurusCalonController::class, 'tolak'])
        ->name('admin-pengurus.calon.tolak');

    Route::delete('/calon-anggota/{id}', [AdminPengurusCalonController::class, 'destroy'])
        ->name('admin-pengurus.calon.destroy');

    // ======================================================
    // JADWAL
    // ======================================================

        Route::get('/jadwal', [AdminPengurusJadwalController::class, 'index'])
            ->name('admin-pengurus.jadwal');

        Route::get('/jadwal/create', [AdminPengurusJadwalController::class, 'create'])
            ->name('admin-pengurus.jadwal.create');

        Route::post('/jadwal/store', [AdminPengurusJadwalController::class, 'store'])
            ->name('admin-pengurus.jadwal.store');

        Route::get('/jadwal/{id}/edit', [AdminPengurusJadwalController::class, 'edit'])
            ->name('admin-pengurus.jadwal.edit');

        Route::put('/jadwal/{id}/update', [AdminPengurusJadwalController::class, 'update'])
            ->name('admin-pengurus.jadwal.update');

        Route::delete('/jadwal/{id}/delete', [AdminPengurusJadwalController::class, 'destroy'])
            ->name('admin-pengurus.jadwal.delete');

    // ======================================================
    // KONTAK
    // ======================================================

            Route::get('/kontak', [AdminPengurusKontakController::class, 'index'])
                ->name('admin-pengurus.kontak');

            Route::get('/kontak/create', [AdminPengurusKontakController::class, 'create'])
                ->name('admin-pengurus.kontak.create');

            Route::post('/kontak/store', [AdminPengurusKontakController::class, 'store'])
                ->name('admin-pengurus.kontak.store');

            Route::get('/kontak/{id}/edit', [AdminPengurusKontakController::class, 'edit'])
                ->name('admin-pengurus.kontak.edit');

            Route::put('/kontak/{id}', [AdminPengurusKontakController::class, 'update'])
                ->name('admin-pengurus.kontak.update');

            Route::delete('/kontak/{id}', [AdminPengurusKontakController::class, 'destroy'])
                ->name('admin-pengurus.kontak.destroy');


// ======================================================
// GALERI
// ======================================================

Route::get('/galeri', [AdminPengurusGaleriController::class, 'index'])
    ->name('admin-pengurus.galeri');

Route::get('/galeri/create', [AdminPengurusGaleriController::class, 'create'])
    ->name('admin-pengurus.galeri.create');

Route::post('/galeri/store', [AdminPengurusGaleriController::class, 'store'])
    ->name('admin-pengurus.galeri.store');

Route::get('/galeri/{id}/edit', [AdminPengurusGaleriController::class, 'edit'])
    ->name('admin-pengurus.galeri.edit');

Route::put('/galeri/{id}', [AdminPengurusGaleriController::class, 'update'])
    ->name('admin-pengurus.galeri.update');

Route::delete('/galeri/{id}', [AdminPengurusGaleriController::class, 'destroy'])
    ->name('admin-pengurus.galeri.destroy');

});