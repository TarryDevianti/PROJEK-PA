<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPengurusKegiatanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $ukm = $user->ukm;

        if (!$ukm) {
            abort(403, 'UKM tidak ditemukan');
        }

        $kegiatan = Kegiatan::where('ukm_id', $ukm->id)
            ->latest()
            ->get();

        return view(
            'admin_pengurus.kegiatan.index',
            compact('kegiatan', 'ukm')
        );
    }

    public function create()
    {
        return view('admin_pengurus.kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal_kegiatan' => 'required',
            'lokasi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')
                ->store('kegiatan', 'public');
        }

        Kegiatan::create([
            'ukm_id' => Auth::user()->ukm_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'lokasi' => $request->lokasi,
            'foto' => $foto,
            'status' => 'published',
            'views' => 0,
        ]);

        return redirect()
            ->route('admin-pengurus.kegiatan')
            ->with('success', 'Kegiatan berhasil ditambahkan');
    }

    public function destroy($id)
{
    $kegiatan = Kegiatan::findOrFail($id);

    // hapus foto jika ada
    if ($kegiatan->foto && \Storage::disk('public')->exists($kegiatan->foto)) {
        \Storage::disk('public')->delete($kegiatan->foto);
    }

    // hapus data kegiatan
    $kegiatan->delete();

    return redirect()
        ->route('admin-pengurus.kegiatan')
        ->with('success', 'Kegiatan berhasil dihapus');
}

public function show($id)
{
    $kegiatan = Kegiatan::findOrFail($id);

    return view(
        'admin_pengurus.kegiatan.show',
        compact('kegiatan')
    );
}

public function edit($id)
{
    $kegiatan = Kegiatan::findOrFail($id);

    return view(
        'admin_pengurus.kegiatan.edit',
        compact('kegiatan')
    );
}

public function update(Request $request, $id)
{
    $kegiatan = Kegiatan::findOrFail($id);

    $request->validate([
        'judul' => 'required',
        'deskripsi' => 'required',
        'tanggal_kegiatan' => 'required',
        'lokasi' => 'required',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('foto')) {

        $foto = $request->file('foto')
            ->store('kegiatan', 'public');

        $kegiatan->foto = $foto;
    }

    $kegiatan->judul = $request->judul;
    $kegiatan->deskripsi = $request->deskripsi;
    $kegiatan->tanggal_kegiatan = $request->tanggal_kegiatan;
    $kegiatan->lokasi = $request->lokasi;

    $kegiatan->save();

    return redirect()
        ->route('admin-pengurus.kegiatan')
        ->with('success', 'Kegiatan berhasil diupdate');
}
}
