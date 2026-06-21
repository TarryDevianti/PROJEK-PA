<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ukm;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UkmController extends Controller
{
    /**
     * Menampilkan daftar UKM
     */
    public function index()
    {
        $ukms = Ukm::with('jadwal')->get();

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
     * Menyimpan data UKM
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ukm'      => 'required|unique:ukms,nama_ukm',
            'deskripsi'     => 'nullable',
            'logo'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'        => 'required|in:aktif,nonaktif',

            // Jadwal
            'sesi_1_buka'   => 'nullable|date',
            'sesi_1_tutup'  => 'nullable|date|after_or_equal:sesi_1_buka',

            'sesi_2_buka'   => 'nullable|date',
            'sesi_2_tutup'  => 'nullable|date|after_or_equal:sesi_2_buka',
        ]);


        // Simpan UKM
        $ukm = new Ukm();

        $ukm->nama_ukm  = $request->nama_ukm;
        $ukm->slug      = Str::slug($request->nama_ukm);
        $ukm->deskripsi = $request->deskripsi;
        $ukm->status    = $request->status;


        // Upload logo
        if ($request->hasFile('logo')) {

            $logoPath = $request->file('logo')
                                ->store('logos', 'public');

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


        return redirect()
                ->route('manajemen-ukm.index')
                ->with('success', 'UKM berhasil ditambahkan');
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
            'nama_ukm'      => 'required|unique:ukms,nama_ukm,' . $id,
            'deskripsi'     => 'nullable',
            'logo'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'        => 'required|in:aktif,nonaktif',

            // Jadwal
            'sesi_1_buka'   => 'nullable|date',
            'sesi_1_tutup'  => 'nullable|date|after_or_equal:sesi_1_buka',

            'sesi_2_buka'   => 'nullable|date',
            'sesi_2_tutup'  => 'nullable|date|after_or_equal:sesi_2_buka',
        ]);


        // Simpan slug lama
        $oldSlug = $ukm->slug;


        // Update UKM
        $ukm->nama_ukm  = $request->nama_ukm;
        $ukm->slug      = Str::slug($request->nama_ukm);
        $ukm->deskripsi = $request->deskripsi;
        $ukm->status    = $request->status;


        // Update logo
        if ($request->hasFile('logo')) {

            $logoPath = $request->file('logo')
                                ->store('logos', 'public');

            $ukm->logo = $logoPath;
        }

        $ukm->save();


        // Update jadwal
        Jadwal::updateOrCreate(

            [
                'ukm_slug' => $oldSlug
            ],

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
                ->with('success', 'UKM berhasil diperbarui');
    }



    /**
     * Hapus UKM
     */
    public function destroy($id)
    {
        $ukm = Ukm::findOrFail($id);


        // Hapus jadwal terkait
        Jadwal::where('ukm_slug', $ukm->slug)->delete();


        // Hapus UKM
        $ukm->delete();


        return redirect()
                ->route('manajemen-ukm.index')
                ->with('success', 'UKM berhasil dihapus');
    }

    public function detail($slug) 
{
    // Cari data UKM berdasarkan slug
    $ukm = Ukm::where('slug', $slug)->firstOrFail();
    
    // Pastikan $ukmId didefinisikan di sini
    $ukmId = $ukm->id; 

    // Kirim variabel $ukm, $ukmId, dll ke view
    return view('user.ukm.detail', compact('ukm', 'ukmId'));
}
}