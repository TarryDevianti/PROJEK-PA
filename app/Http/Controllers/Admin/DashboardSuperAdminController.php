<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ukm;
use App\Models\Pendaftaran;

class DashboardSuperAdminController extends Controller
{
    public function index()
    {
        // ==========================================
        // STATISTIK UTAMA
        // ==========================================
        
        // Total UKM (semua, termasuk nonaktif)
        $totalUkm = Ukm::count();
        
        // Total UKM Aktif
        $totalUkmAktif = Ukm::where('status', 'aktif')->count();
        
        // Total User (semua role)
        $totalUser = User::count();
        
        // Total Anggota (role = 'anggota')
        $totalAnggota = User::where('role', 'anggota')->count();
        
        // Total Admin Pengurus (role seperti admin_%)
        $totalAdmin = User::where('role', 'like', 'admin_%')->count();
        
        // Total Pendaftaran
        $totalPendaftaran = Pendaftaran::count();


        // ==========================================
        // DATA PER UKM - DINAMIS
        // ==========================================
        
        // Ambil semua UKM yang aktif
        $ukms = Ukm::where('status', 'aktif')->orderBy('nama_ukm')->get();
        
        $ukmData = [];
        $chartLabels = [];
        $chartData = [];
        $chartColors = [];

        // Warna untuk setiap UKM (palet warna hangat)
        $colorPalette = [
            ['#d4a373', '#e9c46a', 'fa-users', '#f4a261'],
            ['#52b788', '#2d6a4f', 'fa-users', '#52b788'],
            ['#b388ff', '#7c4dff', 'fa-users', '#b388ff'],
            ['#f94144', '#f4845f', 'fa-users', '#f94144'],
            ['#4cc9f0', '#4361ee', 'fa-users', '#4cc9f0'],
            ['#f15bb5', '#f72585', 'fa-users', '#f15bb5'],
            ['#7209b7', '#560bad', 'fa-users', '#7209b7'],
            ['#06d6a0', '#118ab2', 'fa-users', '#06d6a0'],
        ];

        // Icon options untuk setiap UKM
        $iconOptions = [
            'fa-music', 'fa-mosque', 'fa-tree', 'fa-camera', 
            'fa-book', 'fa-futbol', 'fa-paint-brush', 'fa-laptop-code',
            'fa-heart', 'fa-star', 'fa-sun', 'fa-moon'
        ];

        foreach ($ukms as $index => $ukm) {
            // Hitung anggota per UKM
            $total = User::where('ukm_id', $ukm->id)
                        ->where('role', 'anggota')
                        ->count();

            $colorIndex = $index % count($colorPalette);
            $iconIndex = $index % count($iconOptions);
            $colors = $colorPalette[$colorIndex];

            $ukmData[] = [
                'id' => $ukm->id,
                'name' => $ukm->nama_ukm,
                'slug' => $ukm->slug,
                'total' => $total,
                'color' => $colors[0],
                'color2' => $colors[1],
                'icon' => $iconOptions[$iconIndex],
                'iconColor' => $colors[3],
                'logo' => $ukm->logo ? asset('storage/' . $ukm->logo) : null,
            ];

            $chartLabels[] = $ukm->nama_ukm;
            $chartData[] = $total;
            $chartColors[] = $colors[0];
        }

        // ==========================================
        // DATA UNTUK STATISTIK CARD (Backward Compatible)
        // ==========================================
        
        $seuramoe = 0;
        $barracuda = 0;
        $ululAlbab = 0;

        // Cari data berdasarkan nama UKM
        foreach ($ukms as $ukm) {
            $nameLower = strtolower($ukm->nama_ukm);
            if (strpos($nameLower, 'seuramoe') !== false || strpos($nameLower, 'seramoe') !== false) {
                $seuramoe = User::where('ukm_id', $ukm->id)->where('role', 'anggota')->count();
            } elseif (strpos($nameLower, 'barracuda') !== false) {
                $barracuda = User::where('ukm_id', $ukm->id)->where('role', 'anggota')->count();
            } elseif (strpos($nameLower, 'ulul') !== false || strpos($nameLower, 'albab') !== false) {
                $ululAlbab = User::where('ukm_id', $ukm->id)->where('role', 'anggota')->count();
            }
        }

        // ==========================================
        // DATA UNTUK ADMIN PENGURUS PER UKM
        // ==========================================
        
        $adminPerUkm = [];
        foreach ($ukms as $ukm) {
            $admin = User::where('ukm_id', $ukm->id)
                        ->where('role', 'like', 'admin_%')
                        ->first();
            
            $adminPerUkm[$ukm->id] = $admin ? $admin->name : 'Belum ada admin';
        }

        return view('admin.pages.dashboard_super_admin.index', compact(
            'totalUkm',
            'totalUkmAktif',
            'totalUser',
            'totalAnggota',
            'totalAdmin',
            'totalPendaftaran',
            'ukmData',
            'chartLabels',
            'chartData',
            'chartColors',
            'seuramoe',
            'barracuda',
            'ululAlbab',
            'adminPerUkm'
        ));
    }
}