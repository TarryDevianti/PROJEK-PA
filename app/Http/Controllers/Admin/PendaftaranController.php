<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PendaftaranController extends Controller
{
   
public function index()
{
    $admin = Auth::user();

    if (!$admin) {
        abort(403, 'Unauthorized');
    }

    // SUPER ADMIN
    if ($admin->role === 'super_admin') {

        $pendaftaran = Pendaftaran::latest()->get();

        return view('admin.pages.pendaftaran.index', compact('pendaftaran'));
    }

    // ADMIN PENGURUS
    $ukmNama = $admin->ukm->nama_ukm ?? null;

    if (!$ukmNama) {

        $pendaftaran = collect();

    } else {

        $pendaftaran = Pendaftaran::where('ukm_tujuan', $ukmNama)
            ->latest()
            ->get();
    }

    return view('admin_pengurus.pendaftaran.index', compact('pendaftaran'));
}


    public function show($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('admin.pages.pendaftaran.show', compact('pendaftaran'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak',
            'catatan_admin' => 'nullable|string',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran->update([
            'status' => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        return back()->with('success', 'Status berhasil diperbarui');
    }

    public function destroy($id)
    {
        if (Auth::user()->role === 'super_admin') {
            return back()->with('error', 'Super Admin tidak boleh menghapus data.');
        }

        try {
            $data = Pendaftaran::findOrFail($id);

            if ($data->foto) {
                Storage::disk('public')->delete($data->foto);
            }

            $data->delete();

            return back()->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function dashboard()
    {
        $user = Auth::user();

        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

        return view('user.dashboard', compact('pendaftaran'));
    }

    public function showForm($ukm_slug)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $map = [
            'seuramoe' => 'UKM SERAMOE',
            'ulul-albab' => 'UKM LDF ULUL ALBAB',
            'barracuda' => 'UKM BARRACUDA'
        ];

        if (!isset($map[$ukm_slug])) {
            return redirect()->route('beranda');
        }

        return view('user.pendaftaran.isi_formulir', [
            'user' => Auth::user(),
            'ukmNama' => $map[$ukm_slug]
        ]);
    }

    public function terimaAnggota($id)
    {
        if (Auth::user()->role === 'super_admin') {
            return back()->with('error', 'Tidak diizinkan');
        }

        $pendaftaran = Pendaftaran::findOrFail($id);
        $user = User::findOrFail($pendaftaran->user_id);

        $user->update(['status_diterima' => 'diterima']);
        $pendaftaran->update(['status' => 'diterima']);

        return back()->with('success', 'Diterima');
    }

    public function adminPengurus()
{
    $user = auth()->user();

    $ukm = $user->ukm;

    if (!$ukm) {
        abort(404, 'UKM tidak ditemukan');
    }

    $pendaftaran = Pendaftaran::where('ukm_tujuan', $ukm->nama_ukm)
        ->latest()
        ->get();

    return view('admin.pages.pendaftaran.index', compact('pendaftaran'));
}

public function storeForm(Request $request)
{
    $user = Auth::user();

    // cek apakah sudah pernah daftar
    if (Pendaftaran::where('npm', $user->npm)->exists()) {

        return back()->with('error', 'Sudah daftar.');
    }

    $request->validate([
        'ukm_tujuan' => 'required',
        'divisi_tujuan' => 'required',
        'alasan' => 'required',
        'alamat' => 'required',
        'foto' => 'required|image|max:2048',
    ]);

    try {

        DB::transaction(function () use ($request, $user) {

            // upload foto
            $foto = $request->file('foto')->store('foto', 'public');

            // simpan data
            Pendaftaran::create([

                'user_id' => $user->id,
                'nama_lengkap' => $user->name,

                'npm' => $user->npm,

                // INI YANG DIPERBAIKI
                'prodi' => $user->program_studi ?? '-',

                'email' => $user->email,

                // INI JUGA DIPERBAIKI
                'no_telepon' => $user->telepon ?? '-',

                'angkatan' => $user->angkatan,

                'ukm_tujuan' => $request->ukm_tujuan,
                'divisi_tujuan' => $request->divisi_tujuan,
                'alasan' => $request->alasan,
                'alamat' => $request->alamat,

                'foto' => $foto,

                'status' => 'pending',
            ]);
        });

        // LINK GRUP WHATSAPP
        $linkGrup = match ($request->ukm_tujuan) {

            'UKM SERAMOE' =>
                'https://chat.whatsapp.com/LINK_SERAMOE',

            'UKM LDF ULUL ALBAB' =>
                'https://chat.whatsapp.com/FCxzRHsuzs83bY60ouGQ2k',

            'UKM BARRACUDA' =>
                'https://chat.whatsapp.com/FCxzRHsuzs83bY60ouGQ2k',

            default => route('beranda'),
        };

        return redirect()->away($linkGrup);

    } catch (\Exception $e) {

        Log::error($e->getMessage());

        return back()->with('error', 'Gagal daftar');
    }
}
}