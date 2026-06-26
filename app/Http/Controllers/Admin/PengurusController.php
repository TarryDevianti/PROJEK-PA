<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    // Menampilkan semua data pengurus dengan pagination
    public function index()
    {
        // Gunakan paginate() untuk pagination
        $pengurus = Pengurus::orderBy('urutan', 'asc')->paginate(10);
        return view('admin.pages.pengurus.index', compact('pengurus'));
    }

    // Menampilkan form tambah data
    public function create()
    {
        // Ambil semua anggota yang sudah diterima
        $pendaftar = Pendaftaran::where('status', 'diterima')
            ->orderBy('nama_lengkap', 'asc')
            ->get();

        return view('admin.pages.pengurus.create', compact('pendaftar'));
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftarans,id',
            'jabatan' => 'required|string|max:255',
            'periode' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ]);

        // Ambil data pendaftar
        $pendaftar = Pendaftaran::findOrFail($request->pendaftaran_id);

        // Cek apakah jabatan sudah ada di UKM yang sama
        $cekJabatan = Pengurus::where('ukm_slug', $pendaftar->ukm_tujuan)
            ->where('jabatan', $request->jabatan)
            ->exists();

        if ($cekJabatan) {
            return back()->with('error', 'Jabatan tersebut sudah ada pada UKM ini.')
                ->withInput();
        }

        // Simpan pengurus
        Pengurus::create([
            'user_id' => $pendaftar->user_id,
            'nama' => $pendaftar->nama_lengkap,
            'jabatan' => $request->jabatan,
            'periode' => $request->periode,
            'foto' => $pendaftar->foto,
            'ukm_slug' => $pendaftar->ukm_tujuan,
            'deskripsi' => $request->deskripsi,
            'urutan' => $request->urutan ?? 0,
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        return redirect()->route('pengurus.admin')
            ->with('success', 'Pengurus berhasil ditambahkan.');
    }

    // Menampilkan form edit data
    public function edit($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        return view('admin.pages.pengurus.edit', compact('pengurus'));
    }

    // Mengupdate data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'periode' => 'required|string|max:100',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
            'urutan' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ]);

        $pengurus = Pengurus::findOrFail($id);
        $data = $request->all();

        // Handle upload foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($pengurus->foto && Storage::disk('public')->exists($pengurus->foto)) {
                Storage::disk('public')->delete($pengurus->foto);
            }
            
            $file = $request->file('foto');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $path = $file->storeAs('pengurus', $filename, 'public');
            $data['foto'] = $path;
        }

        // Set default value untuk is_active
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $pengurus->update($data);

        return redirect()->route('pengurus.admin')
            ->with('success', 'Data pengurus berhasil diupdate');
    }

    // Menghapus data
    public function destroy($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        
        // Hapus foto
        if ($pengurus->foto && Storage::disk('public')->exists($pengurus->foto)) {
            Storage::disk('public')->delete($pengurus->foto);
        }
        
        $pengurus->delete();

        return redirect()->route('pengurus.admin')
            ->with('success', 'Data pengurus berhasil dihapus');
    }
}