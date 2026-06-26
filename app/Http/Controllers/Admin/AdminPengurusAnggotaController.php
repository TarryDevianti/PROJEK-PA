<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPengurusAnggotaController extends Controller
{
    /**
     * Menampilkan daftar anggota yang sudah diterima untuk UKM admin
     */
    public function index()
    {
        $user = Auth::user();
        $ukm = $user->ukm;

        if (!$ukm) {
            abort(403, 'UKM tidak ditemukan.');
        }

        // Gunakan SLUG sebagai acuan (pastikan di database ukm_tujuan = slug)
        $slug = $ukm->slug;

        // Debug: hitung total data dengan slug ini (untuk pengecekan)
        $totalData = Pendaftaran::where('ukm_tujuan', $slug)->count();

        // Ambil data anggota dengan status diterima
        $anggota = Pendaftaran::where('ukm_tujuan', $slug)
            ->where('status', 'diterima')
            ->latest()
            ->get();

        return view('admin_pengurus.anggota.index', compact('anggota', 'totalData', 'slug'));
    }

    /**
     * Detail anggota
     */
    public function show($id)
    {
        $user = Auth::user();
        $ukm = $user->ukm;

        if (!$ukm) {
            abort(403, 'UKM tidak ditemukan.');
        }

        $anggota = Pendaftaran::where('ukm_tujuan', $ukm->slug)
            ->findOrFail($id);

        return view('admin_pengurus.anggota.show', compact('anggota'));
    }

    /**
     * Form tambah anggota (manual oleh admin)
     */
    public function create()
    {
        return view('admin_pengurus.anggota.create');
    }

    /**
     * Simpan anggota baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'npm'          => 'required|string|max:50|unique:pendaftaran,npm',
            'prodi'        => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'no_telepon'   => 'required|string|max:20',
            'angkatan'     => 'required|string|max:4',
            'divisi_tujuan'=> 'required|string|max:255',
        ]);

        $user = Auth::user();
        $ukm = $user->ukm;

        if (!$ukm) {
            abort(403, 'UKM tidak ditemukan.');
        }

        Pendaftaran::create([
            'nama_lengkap'   => $request->nama_lengkap,
            'npm'            => $request->npm,
            'prodi'          => $request->prodi,
            'email'          => $request->email,
            'no_telepon'     => $request->no_telepon,
            'angkatan'       => $request->angkatan,
            'divisi_tujuan'  => $request->divisi_tujuan,
            'ukm_tujuan'     => $ukm->slug, // <-- PASTIKAN PAKAI SLUG
            'status'         => 'diterima',
        ]);

        return redirect()
            ->route('admin-pengurus.anggota')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    /**
     * Form edit anggota
     */
    public function edit($id)
    {
        $user = Auth::user();
        $ukm = $user->ukm;

        if (!$ukm) {
            abort(403, 'UKM tidak ditemukan.');
        }

        $anggota = Pendaftaran::where('ukm_tujuan', $ukm->slug)
            ->findOrFail($id);

        return view('admin_pengurus.anggota.edit', compact('anggota'));
    }

    /**
     * Update data anggota
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'npm'          => 'required|string|max:50|unique:pendaftaran,npm,' . $id,
            'prodi'        => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'no_telepon'   => 'required|string|max:20',
            'angkatan'     => 'required|string|max:4',
            'divisi_tujuan'=> 'required|string|max:255',
            'no_anggota'   => 'nullable|string|max:50',
            'jabatan'      => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $ukm = $user->ukm;

        if (!$ukm) {
            abort(403, 'UKM tidak ditemukan.');
        }

        $anggota = Pendaftaran::where('ukm_tujuan', $ukm->slug)
            ->findOrFail($id);

        $anggota->update([
            'nama_lengkap'   => $request->nama_lengkap,
            'npm'            => $request->npm,
            'prodi'          => $request->prodi,
            'email'          => $request->email,
            'no_telepon'     => $request->no_telepon,
            'angkatan'       => $request->angkatan,
            'divisi_tujuan'  => $request->divisi_tujuan,
            'no_anggota'     => $request->no_anggota,
            'jabatan'        => $request->jabatan,
        ]);

        return redirect()
            ->route('admin-pengurus.anggota')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    /**
     * Hapus anggota
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $ukm = $user->ukm;

        if (!$ukm) {
            abort(403, 'UKM tidak ditemukan.');
        }

        $anggota = Pendaftaran::where('ukm_tujuan', $ukm->slug)
            ->findOrFail($id);

        if ($anggota->foto && \Storage::disk('public')->exists($anggota->foto)) {
            \Storage::disk('public')->delete($anggota->foto);
        }

        $anggota->delete();

        return redirect()
            ->route('admin-pengurus.anggota')
            ->with('success', 'Data anggota berhasil dihapus.');
    }
}