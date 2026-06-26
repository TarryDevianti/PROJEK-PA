<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Kegiatan;
use App\Models\Galeri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminPengurusController extends Controller
{
    /**
     * Dashboard Admin Pengurus
     */
    public function dashboard()
    {
        $user = Auth::user();
        $ukm = $user->ukm;

        if (!$ukm) {
            abort(403, 'Anda belum terdaftar sebagai pengurus UKM.');
        }

        // Total anggota diterima
        $jumlahAnggota = Pendaftaran::where('ukm_tujuan', $ukm->slug)
            ->where('status', 'diterima')
            ->count();

        // Calon anggota (pending)
        $calonAnggota = Pendaftaran::where('ukm_tujuan', $ukm->slug)
            ->where('status', 'pending')
            ->count();

        // Jumlah kegiatan
        $jumlahKegiatan = Kegiatan::where('ukm_id', $ukm->id)->count();

        // Jumlah galeri
        $jumlahGaleri = Galeri::where('ukm_id', $ukm->id)->count();

        // ==========================
        // Statistik pendaftaran per bulan
        // ==========================
        $statistik = Pendaftaran::where('ukm_tujuan', $ukm->slug)
            ->select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // ==========================
        // Pendaftaran terbaru (5 data)
        // ==========================
        $pendaftaranTerbaru = Pendaftaran::where('ukm_tujuan', $ukm->slug)
            ->latest()
            ->take(5)
            ->get();

        // ==========================
        // GALERI TERBARU (5 data) — GANTI KEGIATAN
        // ==========================
        $galeriTerbaru = Galeri::where('ukm_id', $ukm->id)
            ->latest()
            ->take(5)
            ->get();

       return view('admin_pengurus.dashboard', compact(
    'ukm',
    'jumlahAnggota',
    'calonAnggota',
    'jumlahKegiatan',
    'jumlahGaleri',
    'statistik',
    'pendaftaranTerbaru',
    'galeriTerbaru'
));
    }
    /**
     * Halaman Profil Admin Pengurus
     */
    public function profil()
    {
        $user = Auth::user();
        return view('admin_pengurus.anggota.profil', compact('user'));
    }
}