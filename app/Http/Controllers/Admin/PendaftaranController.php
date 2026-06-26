<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ukm;
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
    /**
     * Menampilkan halaman pilih UKM untuk mahasiswa
     */
    public function pilihUkm()
    {
        $ukms = Ukm::where('status', 'aktif')->get();
        return view('mahasiswa.pilih_ukm', compact('ukms'));
    }

    /**
     * Menampilkan daftar pendaftaran untuk admin
     */
   public function index()
{
    $admin = Auth::user();

    if (!$admin) {
        abort(403, 'Unauthorized');
    }

    // SUPER ADMIN
    if ($admin->role === 'super_admin') {

        $pendaftaran = Pendaftaran::with('user')
            ->latest()
            ->get();

        return view('admin.pages.pendaftaran.index', compact('pendaftaran'));
    }

    // ADMIN UKM
    $ukm = $admin->ukm;

    if (!$ukm) {
        $pendaftaran = collect();
    } else {

        $pendaftaran = Pendaftaran::with('user')
            ->where('ukm_tujuan', $ukm->slug)
            ->latest()
            ->get();
    }

    return view('admin_pengurus.pendaftaran.index', compact('pendaftaran'));
}

    /**
     * Menampilkan detail pendaftaran
     */
    public function show($id)
    {
        $pendaftaran = Pendaftaran::with(['user', 'ukm'])->findOrFail($id);
        return view('admin.pages.pendaftaran.show', compact('pendaftaran'));
    }

    /**
     * Update status pendaftaran
     */
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

        // Jika diterima, update status user
        if ($request->status === 'diterima') {
            $user = User::find($pendaftaran->user_id);
            if ($user) {
                $user->update(['status_diterima' => 'diterima']);
            }
        }

        return back()->with('success', 'Status berhasil diperbarui');
    }

    /**
     * Hapus data pendaftaran
     */
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

    /**
     * Dashboard user (mahasiswa)
     */
    public function dashboard()
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();
        return view('user.dashboard', compact('pendaftaran'));
    }

    /**
     * Menampilkan form pendaftaran UKM
     */
    public function showForm($ukm_slug)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }

    $ukm = Ukm::where('slug', $ukm_slug)->first();

    if (!$ukm) {
        return redirect()->route('pilih.ukm')->with('error', 'UKM tidak ditemukan, silakan pilih UKM lain.');
    }

    $user = Auth::user();
    $sudahDaftar = Pendaftaran::where('user_id', $user->id)->exists();

    if ($sudahDaftar) {
        return redirect()->route('dashboard')->with('error', 'Anda sudah mendaftar UKM.');
    }

    $ukms = Ukm::where('status', 'aktif')->get();

    return view('user.pendaftaran.isi_formulir', [
        'user' => $user,
        'ukm' => $ukm,
        'ukmId' => $ukm->id,
        'ukmNama' => $ukm->nama_ukm,
        'ukms' => $ukms,
    ]);
}

    public function storeForm(Request $request)
{
    $user = Auth::user();

    // Cek apakah sudah pernah daftar
    if (Pendaftaran::where('user_id', $user->id)->exists()) {
        return back()->with('error', 'Anda sudah pernah mendaftar.');
    }

    // Validasi
    $request->validate([
        'ukm_id' => 'required|exists:ukms,id',
        'divisi_tujuan' => 'required|string',
        'alasan' => 'required|string',
        'alamat' => 'required|string',
        'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    try {
        DB::transaction(function () use ($request, $user) {
            // Upload foto
            $foto = $request->file('foto')->store('foto_pendaftaran', 'public');

            // Ambil UKM untuk mendapatkan slug
            $ukm = Ukm::find($request->ukm_id);

            // Simpan data
            Pendaftaran::create([
                'user_id' => $user->id,
                'nama_lengkap' => $user->name,
                'npm' => $user->npm,
                'prodi' => $user->program_studi ?? '-',
                'email' => $user->email,
                'no_telepon' => $user->telepon ?? '-',
                'angkatan' => $user->angkatan,
                'ukm_id' => $request->ukm_id,
                'ukm_tujuan' => $ukm->slug, // <--- TAMBAHKAN INI
                'divisi_tujuan' => $request->divisi_tujuan,
                'alasan' => $request->alasan,
                'alamat' => $request->alamat,
                'foto' => $foto,
                'status' => 'pending',
            ]);
        });

        // Ambil data UKM
        $ukm = Ukm::find($request->ukm_id);

        // Link grup WhatsApp berdasarkan slug
        $linkGrup = match ($ukm->slug) {
            'seuramoe', 'seramoe', 'ukm-seramoe' => 'https://chat.whatsapp.com/LINK_SERAMOE',
            'ulul-albab', 'ukm-ldf-ulul-albab' => 'https://chat.whatsapp.com/FCxzRHsuzs83bY60ouGQ2k',
            'barracuda', 'ukm-barracuda' => 'https://chat.whatsapp.com/FCxzRHsuzs83bY60ouGQ2k',
            default => route('beranda'),
        };

        return redirect()->away($linkGrup);

    } catch (\Exception $e) {
        Log::error('Error pendaftaran: ' . $e->getMessage());
        return back()->with('error', 'Gagal mendaftar: ' . $e->getMessage());
    }
}
    /**
     * Terima anggota (admin pengurus)
     */
    public function terimaAnggota($id)
    {
        if (Auth::user()->role === 'super_admin') {
            return back()->with('error', 'Tidak diizinkan');
        }

        $pendaftaran = Pendaftaran::findOrFail($id);
        $user = User::findOrFail($pendaftaran->user_id);

        $user->update(['status_diterima' => 'diterima']);
        $pendaftaran->update(['status' => 'diterima']);

        return back()->with('success', 'Anggota berhasil diterima');
    }

    /**
     * Dashboard admin pengurus
     */
    public function adminPengurus()
    {
        $user = auth()->user();
        $ukm = $user->ukm;

        if (!$ukm) {
            abort(404, 'UKM tidak ditemukan');
        }

        $pendaftaran = Pendaftaran::where('ukm_id', $ukm->id)->latest()->get();

        return view('admin.pages.pendaftaran.index', compact('pendaftaran'));
    }
}