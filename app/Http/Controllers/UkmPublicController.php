<?php

namespace App\Http\Controllers;

use App\Models\Ukm;
use App\Models\Jadwal;
use App\Models\Pengurus;
use App\Models\Kegiatan;
use App\Models\Galeri;
use App\Models\Kontak;
use Illuminate\Http\Request;

class UkmPublicController extends Controller
{
    public function show($slug, $tab = 'ukm')
    {
        // Ambil UKM berdasarkan slug
        $ukm = Ukm::where('slug', $slug)->firstOrFail();

        // Ambil data pengurus
        $pengurus = Pengurus::where('ukm_slug', $ukm->slug)
            ->where('is_active', 1)
            ->orderBy('urutan', 'asc')
            ->get();

        $ketua = $pengurus->where('jabatan', 'Ketua')->first();
        $sekretaris = $pengurus->where('jabatan', 'Sekretaris')->first();
        $bendahara = $pengurus->where('jabatan', 'Bendahara')->first();

            $jadwal = Jadwal::where('ukm_slug', $ukm->slug)
            ->latest()
            ->first();

        // Ambil kegiatan
        $kegiatan = Kegiatan::where('ukm_id', $ukm->id)
            ->latest()
            ->get();

        // Ambil galeri
        $galeri = Galeri::where('ukm_id', $ukm->id)
            ->latest()
            ->get();

        // Ambil kontak
        $kontak = Kontak::where('ukm_id', $ukm->id)->first();

        // Tab aktif
        $activeTab = $tab;

        // Validasi tab
        if (!in_array($activeTab, ['ukm', 'divisi', 'galeri', 'jadwal'])) {
            $activeTab = 'ukm';
        }

        return view('user.ukm.detail', compact(
            'ukm',
            'activeTab',
            'jadwal',
            'pengurus',
            'ketua',
            'sekretaris',
            'bendahara',
            'kegiatan',
            'galeri',
            'kontak'
        ));
    }
}