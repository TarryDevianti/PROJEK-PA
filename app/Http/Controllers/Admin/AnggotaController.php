<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ukm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    /**
     * Menampilkan daftar anggota
     */
    public function index($ukm_id = null)
    {
         $user = Auth::user();

        // ==========================================
        // SUPER ADMIN
        // ==========================================
        if ($user->role === 'super_admin') {

            // Semua anggota jika tidak memilih UKM
            if (!$ukm_id) {

                $anggotas = User::with('ukm')
                    ->where('role', 'anggota')
                    ->orderBy('name')
                    ->get();

                return view('admin.pages.anggota.index', [
                    'ukm' => null,
                    'anggotas' => $anggotas
                ]);
            }

            // Anggota berdasarkan UKM
            $ukm = Ukm::findOrFail($ukm_id);

            $anggotas = User::with('ukm')
                ->where('ukm_id', $ukm_id)
                ->where('role', 'anggota')
                ->orderBy('name')
                ->get();

            return view('admin.pages.anggota.index', compact(
                'ukm',
                'anggotas'
            ));
        }

        // ==========================================
        // ADMIN PENGURUS UKM
        // ==========================================
        $ukm = $user->ukm;

        if (!$ukm) {
            abort(403, 'UKM tidak ditemukan.');
        }

        $anggotas = User::with('ukm')
            ->where('ukm_id', $ukm->id)
            ->where('role', 'anggota')
            ->orderBy('name')
            ->get();

        return view('admin.pages.anggota.index', compact(
            'ukm',
            'anggotas'
        ));
    }

    /**
     * Menampilkan profil anggota
     */
    public function show(int $id)
    {
        $anggota = User::with('ukm')
            ->findOrFail($id);

        return view(
            'admin.pages.anggota.profil',
            compact('anggota')
        );
    }

    /**
     * Form edit anggota
     */
    public function edit(int $id)
    {
        $anggota = User::findOrFail($id);

        $ukms = Ukm::all();

        return view(
            'admin.pages.anggota.edit',
            compact('anggota', 'ukms')
        );
    }

    /**
     * Update data anggota
     */
    public function update(Request $request, int $id)
    {
        $anggota = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'npm' => 'nullable',
            'program_studi' => 'nullable',
            'angkatan' => 'nullable',
            'telepon' => 'nullable',
        ]);

        $anggota->update([
            'name' => $request->name,
            'email' => $request->email,
            'npm' => $request->npm,
            'program_studi' => $request->program_studi,
            'angkatan' => $request->angkatan,
            'telepon' => $request->telepon,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    /**
     * Hapus anggota
     */
    public function destroy(int $id)
    {
        $anggota = User::findOrFail($id);

        $anggota->delete();

        return redirect()
            ->back()
            ->with('success', 'Data anggota berhasil dihapus.');
    }
}