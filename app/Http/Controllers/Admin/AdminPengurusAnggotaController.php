<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPengurusAnggotaController extends Controller
{
    // TAMPIL DATA ANGGOTA
    public function index()
    {
        $user = Auth::user();

        $ukm = $user->ukm;

        if (!$ukm) {
            abort(403, 'UKM tidak ditemukan');
        }

        $anggota = Pendaftaran::where('ukm_tujuan', $ukm->nama_ukm)
            ->where('status', 'diterima')
            ->latest()
            ->get();

        return view(
            'admin_pengurus.anggota.index',
            compact('anggota')
        );
    }

    // DETAIL ANGGOTA
    public function show($id)
    {
        $anggota = Pendaftaran::findOrFail($id);

        return view(
            'admin_pengurus.anggota.show',
            compact('anggota')
        );
    }

    // FORM TAMBAH
    public function create()
    {
        return view('admin_pengurus.anggota.create');
    }

    // SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'npm' => 'required',
            'prodi' => 'required',
            'email' => 'required',
            'no_telepon' => 'required',
            'angkatan' => 'required',
            'divisi_tujuan' => 'required',
        ]);

        $user = Auth::user();

        Pendaftaran::create([
            'nama_lengkap' => $request->nama_lengkap,
            'npm' => $request->npm,
            'prodi' => $request->prodi,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'angkatan' => $request->angkatan,
            'divisi_tujuan' => $request->divisi_tujuan,
            'ukm_tujuan' => $user->ukm->nama_ukm,
            'status' => 'diterima',
        ]);

        return redirect()
            ->route('admin-pengurus.anggota')
            ->with('success', 'Anggota berhasil ditambahkan');
    }

    // FORM EDIT
    public function edit($id)
    {
        $anggota = Pendaftaran::findOrFail($id);

        return view(
            'admin_pengurus.anggota.edit',
            compact('anggota')
        );
    }

    // UPDATE DATA
    public function update(Request $request, $id)
{
    $request->validate([
        'nama_lengkap' => 'required',
        'npm' => 'required',
        'prodi' => 'required',
        'email' => 'required',
        'no_telepon' => 'required',
        'angkatan' => 'required',
        'divisi_tujuan' => 'required',
        'no_anggota' => 'nullable',
        'jabatan' => 'nullable',
    ]);

    $anggota = Pendaftaran::findOrFail($id);

    $anggota->update([
        'nama_lengkap' => $request->nama_lengkap,
        'npm' => $request->npm,
        'prodi' => $request->prodi,
        'email' => $request->email,
        'no_telepon' => $request->no_telepon,
        'angkatan' => $request->angkatan,
        'divisi_tujuan' => $request->divisi_tujuan,
        'no_anggota' => $request->no_anggota,
        'jabatan' => $request->jabatan,
    ]);

    return redirect()
        ->route('admin-pengurus.anggota')
        ->with('success', 'Data anggota berhasil diupdate');
}

    // HAPUS DATA
    public function destroy($id)
    {
        $anggota = Pendaftaran::findOrFail($id);

        $anggota->delete();

        return back()->with('success', 'Data anggota berhasil dihapus');
    }
}