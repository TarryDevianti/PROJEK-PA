<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use App\Models\Kegiatan;

class AdminPengurusController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // ambil UKM admin yang login
        $ukm = $user->ukm;

        if (!$ukm) {
            abort(403, 'Admin belum memiliki UKM.');
        }

        // total anggota diterima
        $jumlahAnggota = Pendaftaran::where('ukm_tujuan', $ukm->nama_ukm)
            ->where('status', 'diterima')
            ->count();

        // calon anggota pending
        $calonAnggota = Pendaftaran::where('ukm_tujuan', $ukm->nama_ukm)
            ->where('status', 'pending')
            ->count();

        return view(
            'admin_pengurus.dashboard',
            compact(
                'user',
                'ukm',
                'jumlahAnggota',
                'calonAnggota'
            )
        );
    }

    // HALAMAN PROFIL ADMIN PENGURUS
    public function profil()
    {
        $user = Auth::user();

        return view(
            'admin_pengurus.anggota.profil',
            compact('user')
        );
    }
}