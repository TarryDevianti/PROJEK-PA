<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Ukm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AnggotaController extends Controller
{
    // ==========================================
    // HELPER METHODS (PENGECEKAN AKSES)
    // ==========================================

    protected function getAnggotaOrFail($id)
    {
        $user = Auth::user();

        if ($user->role === 'super_admin') {
            return User::with('ukm')->findOrFail($id);
        }

        $ukm = $user->ukm;
        abort_if(!$ukm, 403, 'UKM tidak ditemukan.');

        return User::where('ukm_id', $ukm->id)
                   ->where('role', 'anggota')
                   ->findOrFail($id);
    }

    protected function getCurrentUkmForAdmin()
    {
        $user = Auth::user();
        if ($user->role === 'super_admin') {
            return null;
        }

        $ukm = $user->ukm;
        abort_if(!$ukm, 403, 'UKM tidak ditemukan.');
        return $ukm;
    }

    // ==========================================
    // UNTUK USER BIASA (MAHASISWA)
    // ==========================================

public function daftar()
{
    $user = Auth::user();

    $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

    if (!$pendaftaran) {
        return redirect()->route('pilih.ukm')
            ->with('info', 'Anda belum terdaftar di UKM manapun.');
    }

    $ukmSlug = $pendaftaran->ukm_tujuan;

    $anggotas = Pendaftaran::where('ukm_tujuan', $ukmSlug)
        ->where('status', 'diterima')
        ->orderBy('nama_lengkap')
        ->get();

    $ukm = Ukm::where('slug', $ukmSlug)->first();

    return view('pages.anggota.index', compact('anggotas', 'ukm'));
}
    public function profilUser($id)
    {
        $user = Auth::user();
        $userPendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        if (!$userPendaftaran) {
            return redirect()->route('pilih.ukm')
                ->with('info', 'Anda belum terdaftar di UKM manapun.');
        }

        $ukmSlug = $userPendaftaran->ukm_tujuan;
        $anggota = Pendaftaran::where('ukm_tujuan', $ukmSlug)
            ->where('id', $id)
            ->firstOrFail();

        // 📁 resources/views/pages/profil.blade.php
        return view('pages.profil', compact('anggota'));
    }

    // ==========================================
    // UNTUK ADMIN (SUPER ADMIN & ADMIN PENGURUS)
    // ==========================================

    public function index(Request $request, $ukm_id = null)
    {
        $user = Auth::user();
        $search = $request->get('search');

        $query = User::with('ukm')->where('role', 'anggota');

        if ($user->role !== 'super_admin') {
            $ukm = $this->getCurrentUkmForAdmin();
            $query->where('ukm_id', $ukm->id);
            $ukm_id = $ukm->id;
        }

        if ($user->role === 'super_admin' && $ukm_id) {
            $query->where('ukm_id', $ukm_id);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('npm', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $anggotas = $query->orderBy('name')->paginate(10);
        $ukm = $ukm_id ? Ukm::find($ukm_id) : null;

        // 📁 resources/views/pages/anggota/index.blade.php
        return view('admin.pages.anggota.index', compact('ukm', 'anggotas'));
    }

    public function show($id)
    {
        $anggota = $this->getAnggotaOrFail($id);
        // 📁 resources/views/pages/profil.blade.php
        return view('admin.pages.anggota.profil', compact('anggota'));
    }

    public function edit($id)
    {
        $anggota = $this->getAnggotaOrFail($id);
        $ukms = Ukm::where('status', 'aktif')->get();

        // 📁 resources/views/pages/anggota/edit.blade.php
        return view('admin.pages.anggota.edit', compact('anggota', 'ukms'));
    }

    public function update(Request $request, $id)
    {
        $anggota = $this->getAnggotaOrFail($id);
        $user = Auth::user();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($anggota->id),
            ],
            'npm' => 'nullable|string|max:50',
            'program_studi' => 'nullable|string|max:255',
            'angkatan' => 'nullable|string|max:4',
            'telepon' => 'nullable|string|max:20',
        ];

        if ($user->role === 'super_admin') {
            $rules['ukm_id'] = 'nullable|exists:ukms,id';
        }

        $request->validate($rules);

        $data = $request->only(['name', 'email', 'npm', 'program_studi', 'angkatan', 'telepon']);
        if ($user->role === 'super_admin') {
            $data['ukm_id'] = $request->ukm_id;
        }

        $anggota->update($data);

        return redirect()
            ->route('admin.ukm.anggota', ['ukm_id' => $anggota->ukm_id])
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $anggota = $this->getAnggotaOrFail($id);
        $ukmId = $anggota->ukm_id;
        $anggota->delete();

        return redirect()
            ->route('admin.ukm.anggota', ['ukm_id' => $ukmId])
            ->with('success', 'Data anggota berhasil dihapus.');
    }
}