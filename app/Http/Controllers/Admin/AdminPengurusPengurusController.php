<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use App\Models\Ukm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPengurusPengurusController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $ukm = Ukm::find($user->ukm_id);

        if (!$ukm) {
            abort(404, 'UKM tidak ditemukan.');
        }

        $ukmSlug = $ukm->slug;

        // Data pengurus aktif untuk UKM ini
        $pengurus = Pengurus::with('user')
            ->where('ukm_slug', $ukmSlug)
            ->where('is_active', true)
            ->orderByRaw("FIELD(jabatan, 'ketua', 'sekretaris', 'bendahara')")
            ->get();

        // Daftar anggota aktif yang bisa dipilih (belum menjadi pengurus)
        $anggota = User::where('ukm_id', $user->ukm_id)
            ->where('status_diterima', 'diterima')
            ->where('is_active', true)
            ->whereDoesntHave('pengurus', function ($query) use ($ukmSlug) {
                $query->where('ukm_slug', $ukmSlug)
                      ->where('is_active', true);
            })
            ->get();

        // ✅ Perbaiki: sesuaikan dengan folder view yang ada (pengurus)
        return view('admin_pengurus.data_pengurus.index', compact('pengurus', 'anggota', 'ukm'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jabatan' => 'required|in:ketua,sekretaris,bendahara',
        ]);

        $user = Auth::user();
        $ukm = Ukm::find($user->ukm_id);

        if (!$ukm) {
            return back()->with('error', 'UKM tidak ditemukan.');
        }

        $ukmSlug = $ukm->slug;

        // Cek apakah jabatan sudah terisi oleh pengurus aktif
        $exists = Pengurus::where('ukm_slug', $ukmSlug)
            ->where('jabatan', $request->jabatan)
            ->where('is_active', true)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Jabatan ' . ucfirst($request->jabatan) . ' sudah terisi.');
        }

        $userTerpilih = User::findOrFail($request->user_id);

        Pengurus::create([
            'user_id'    => $userTerpilih->id,
            'ukm_slug'   => $ukmSlug,
            'jabatan'    => $request->jabatan,
            'nama'       => $userTerpilih->name,
            'periode'    => date('Y') . '/' . (date('Y') + 1),
            'is_active'  => true,
        ]);

        // ✅ Perbaiki: gunakan nama route yang valid (tanpa bintang)
        return redirect()
            ->route('admin_pengurus.data_pengurus.index')
            ->with('success', 'Pengurus berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $ukm = Ukm::find($user->ukm_id);

        if (!$ukm) {
            return back()->with('error', 'UKM tidak ditemukan.');
        }

        $pengurus = Pengurus::where('id', $id)
            ->where('ukm_slug', $ukm->slug)
            ->firstOrFail();

        // Soft delete dengan menonaktifkan
        $pengurus->update(['is_active' => false]);

        // ✅ Perbaiki: gunakan nama route yang valid
        return redirect()
            ->route('admin-pengurus.data-pengurus.index')
            ->with('success', 'Pengurus berhasil dihapus.');
    }
}