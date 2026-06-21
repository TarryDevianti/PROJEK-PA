<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class AdminPengurusCalonController extends Controller

{
    public function index()
    {
        $user = Auth::user();

        $ukm = $user->ukm;

        if (!$ukm) {
            abort(403, 'UKM tidak ditemukan');
        }

        $calonAnggota = Pendaftaran::where('ukm_tujuan', $ukm->nama_ukm)
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view(
            'admin_pengurus.calon_anggota.index',
            compact('calonAnggota')
        );
    }

    public function show($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        return view(
            'admin_pengurus.calon_anggota.show',
            compact('pendaftaran')
        );
    }

    public function terima($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran->update([
            'status' => 'diterima'
        ]);

        return back()->with('success', 'Anggota diterima');
    }

    public function tolak($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran->update([
            'status' => 'ditolak'
        ]);

        return back()->with('success', 'Anggota ditolak');
    }

    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}