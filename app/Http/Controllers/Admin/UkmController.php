<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ukm;
use App\Models\User;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UkmController extends Controller
{
    /**
     * Menampilkan daftar UKM
     */
    public function index()
    {
        $ukms = Ukm::with('admin')->get();
        return view('admin.pages.manajemen_ukm.index', compact('ukms'));
    }

    /**
     * Menampilkan form tambah UKM
     */
    public function create()
    {
        return view('admin.pages.manajemen_ukm.create');
    }

    /**
     * Menyimpan data UKM dan auto create admin pengurus
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ukm'      => 'required|unique:ukms,nama_ukm|max:255',
            'deskripsi'     => 'nullable|string',
            'logo'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'        => 'required|in:aktif,nonaktif',

            // Data Admin Pengurus
            'admin_name'    => 'required|string|max:255',
            'admin_email'   => 'required|email|unique:users,email',
            'admin_password' => 'required|min:6',

            // Jadwal
            'sesi_1_buka'   => 'nullable|date',
            'sesi_1_tutup'  => 'nullable|date|after_or_equal:sesi_1_buka',
            'sesi_2_buka'   => 'nullable|date',
            'sesi_2_tutup'  => 'nullable|date|after_or_equal:sesi_2_buka',
        ]);

        // Buat slug dari nama UKM
        $slug = Str::slug($request->nama_ukm);

        // Simpan UKM
        $ukm = new Ukm();
        $ukm->nama_ukm  = $request->nama_ukm;
        $ukm->slug      = $slug;
        $ukm->deskripsi = $request->deskripsi;
        $ukm->status    = $request->status;

        // Upload logo
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $ukm->logo = $logoPath;
        }

        $ukm->save();

        // Simpan jadwal
        Jadwal::create([
            'ukm_slug'      => $ukm->slug,
            'uraian'        => 'Masa Pendaftaran Anggota Baru',
            'sesi_1_buka'   => $request->sesi_1_buka,
            'sesi_1_tutup'  => $request->sesi_1_tutup,
            'sesi_2_buka'   => $request->sesi_2_buka,
            'sesi_2_tutup'  => $request->sesi_2_tutup,
        ]);

        // Create admin pengurus
        $adminData = $this->createAdminFromForm($ukm, $request);

        return redirect()
            ->route('manajemen-ukm.index')
            ->with('success', 'UKM berhasil ditambahkan! Akun admin pengurus telah dibuat.')
            ->with('admin_created', $adminData);
    }

    /**
     * Create admin pengurus dari data form
     */
    private function createAdminFromForm($ukm, $request)
    {
        $role = 'admin_' . strtolower(str_replace(' ', '_', $ukm->nama_ukm));

        $roleMapping = [
            'seuramoe' => 'admin_seramoe',
            'ulul_albab' => 'admin_ulul_albab',
            'ldf_ulul_albab' => 'admin_ulul_albab',
            'barracuda' => 'admin_barracuda'
        ];

        $slugLower = strtolower($ukm->slug);
        foreach ($roleMapping as $key => $value) {
            if (strpos($slugLower, $key) !== false) {
                $role = $value;
                break;
            }
        }

        $user = User::create([
            'name' => $request->admin_name,
            'npm' => $request->admin_npm ?? '999' . str_pad($ukm->id, 8, '0', STR_PAD_LEFT),
            'email' => $request->admin_email,
            'password' => Hash::make($request->admin_password),
            'password_plain' => $request->admin_password,
            'role' => $role,
            'ukm_id' => $ukm->id,
            'is_active' => true,
            'program_studi' => 'Administrasi UKM',
            'angkatan' => date('Y'),
            'telepon' => $request->admin_telepon ?? '081234567890',
            'status_diterima' => 'diterima'
        ]);

        Ukm::where('id', $ukm->id)->update(['user_id' => $user->id]);

        return [
            'name' => $request->admin_name,
            'email' => $request->admin_email,
            'password' => $request->admin_password,
            'role' => $role,
            'npm' => $user->npm
        ];
    }

    /**
     * Menampilkan form edit
     */
    public function edit($id)
    {
        $ukm = Ukm::with('jadwal')->findOrFail($id);
        return view('admin.pages.manajemen_ukm.edit', compact('ukm'));
    }

    /**
     * Update data UKM
     */
    public function update(Request $request, $id)
    {
        $ukm = Ukm::findOrFail($id);

        $request->validate([
            'nama_ukm'      => 'required|unique:ukms,nama_ukm,' . $id . '|max:255',
            'deskripsi'     => 'nullable|string',
            'logo'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'        => 'required|in:aktif,nonaktif',

            'sesi_1_buka'   => 'nullable|date',
            'sesi_1_tutup'  => 'nullable|date|after_or_equal:sesi_1_buka',
            'sesi_2_buka'   => 'nullable|date',
            'sesi_2_tutup'  => 'nullable|date|after_or_equal:sesi_2_buka',
        ]);

        $oldSlug = $ukm->slug;

        $ukm->nama_ukm  = $request->nama_ukm;
        $ukm->slug      = Str::slug($request->nama_ukm);
        $ukm->deskripsi = $request->deskripsi;
        $ukm->status    = $request->status;

        if ($request->hasFile('logo')) {
            if ($ukm->logo && Storage::disk('public')->exists($ukm->logo)) {
                Storage::disk('public')->delete($ukm->logo);
            }
            $logoPath = $request->file('logo')->store('logos', 'public');
            $ukm->logo = $logoPath;
        }

        $ukm->save();

        Jadwal::updateOrCreate(
            ['ukm_slug' => $oldSlug],
            [
                'ukm_slug'      => $ukm->slug,
                'uraian'        => 'Masa Pendaftaran Anggota Baru',
                'sesi_1_buka'   => $request->sesi_1_buka,
                'sesi_1_tutup'  => $request->sesi_1_tutup,
                'sesi_2_buka'   => $request->sesi_2_buka,
                'sesi_2_tutup'  => $request->sesi_2_tutup,
            ]
        );

        return redirect()
            ->route('manajemen-ukm.index')
            ->with('success', 'UKM berhasil diperbarui!');
    }

    /**
     * Hapus UKM
     */
    public function destroy($id)
    {
        $ukm = Ukm::findOrFail($id);

        if ($ukm->logo && Storage::disk('public')->exists($ukm->logo)) {
            Storage::disk('public')->delete($ukm->logo);
        }

        Jadwal::where('ukm_slug', $ukm->slug)->delete();

        if ($ukm->user_id) {
            $admin = User::find($ukm->user_id);
            if ($admin) {
                $admin->delete();
            }
        }

        $ukm->delete();

        return redirect()
            ->route('manajemen-ukm.index')
            ->with('success', 'UKM berhasil dihapus!');
    }
}