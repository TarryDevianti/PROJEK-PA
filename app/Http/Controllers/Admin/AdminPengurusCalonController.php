<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Mail\AnggotaDiterimaMail;
use App\Mail\AnggotaDitolakMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AdminPengurusCalonController extends Controller
{
    /**
     * Menampilkan daftar calon anggota untuk UKM yang dikelola admin
     */
    public function index()
    {
        $user = Auth::user();
        $ukm = $user->ukm;

        if (!$ukm) {
            abort(403, 'UKM tidak ditemukan.');
        }

        $calonAnggota = Pendaftaran::where('ukm_tujuan', $ukm->slug)
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin_pengurus.calon_anggota.index', compact('calonAnggota'));
    }

    /**
     * Menampilkan detail calon anggota
     */
    public function show($id)
    {
        $user = Auth::user();
        $ukm = $user->ukm;

        if (!$ukm) {
            abort(403, 'UKM tidak ditemukan.');
        }

        $pendaftaran = Pendaftaran::where('ukm_tujuan', $ukm->slug)
            ->findOrFail($id);

        return view('admin_pengurus.calon_anggota.show', compact('pendaftaran'));
    }

    /**
     * Menerima calon anggota - UPDATE LENGKAP
     */
   public function terima($id)
{
    $admin = Auth::user();
    $ukm = $admin->ukm;

    if (!$ukm) {
        abort(403, 'UKM tidak ditemukan.');
    }

    $pendaftaran = Pendaftaran::where('ukm_tujuan', $ukm->slug)
        ->findOrFail($id);

    // Update status di pendaftaran
    $pendaftaran->update(['status' => 'diterima']);

    // Update tabel USERS - PASTIKAN SEMUA TERUPDATE
    $calonUser = User::find($pendaftaran->user_id);
    if ($calonUser) {
        $calonUser->update([
            'status_diterima' => 'diterima',
            'ukm_id' => $ukm->id,
        ]);
    }

    // Kirim email
    if ($calonUser && filter_var($calonUser->email, FILTER_VALIDATE_EMAIL)) {
        try {
            Mail::to($calonUser->email)->send(new AnggotaDiterimaMail($calonUser, $ukm, $pendaftaran));
        } catch (\Exception $e) {
            Log::error('Email gagal dikirim: ' . $e->getMessage());
        }
    }

    return back()->with('success', 'Anggota berhasil diterima. User sekarang bisa login.');
}

    /**
     * Menolak calon anggota
     */
    public function tolak($id)
    {
        $admin = Auth::user();
        $ukm = $admin->ukm;

        if (!$ukm) {
            abort(403, 'UKM tidak ditemukan.');
        }

        $pendaftaran = Pendaftaran::where('ukm_tujuan', $ukm->slug)
            ->findOrFail($id);

        // Cek apakah sudah ditolak sebelumnya
        if ($pendaftaran->status === 'ditolak') {
            return back()->with('warning', 'Calon anggota sudah ditolak sebelumnya.');
        }

        $pendaftaran->update(['status' => 'ditolak']);

        // Kirim email notifikasi
        $calonUser = User::find($pendaftaran->user_id);
        if ($calonUser && filter_var($calonUser->email, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($calonUser->email)->send(new AnggotaDitolakMail($calonUser, $ukm, $pendaftaran));
            } catch (\Exception $e) {
                Log::error('Email gagal dikirim: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Calon anggota berhasil ditolak. Email notifikasi telah dikirim.');
    }

    /**
     * Menghapus data calon anggota
     */
    public function destroy($id)
    {
        $admin = Auth::user();
        $ukm = $admin->ukm;

        if (!$ukm) {
            abort(403, 'UKM tidak ditemukan.');
        }

        $pendaftaran = Pendaftaran::where('ukm_tujuan', $ukm->slug)
            ->findOrFail($id);

        // Hapus foto jika ada
        if ($pendaftaran->foto && \Storage::disk('public')->exists($pendaftaran->foto)) {
            \Storage::disk('public')->delete($pendaftaran->foto);
        }

        $pendaftaran->delete();

        return back()->with('success', 'Data calon anggota berhasil dihapus.');
    }
}