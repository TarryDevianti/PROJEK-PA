<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminPengurusGaleriController extends Controller
{
    public function index()
    {
        $ukmId = Auth::user()->ukm ? Auth::user()->ukm->id : null;

        $galeri = Galeri::where('ukm_id', $ukmId)
            ->latest()
            ->get();

        return view('admin_pengurus.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('admin_pengurus.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar'    => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $ukmId = Auth::user()->ukm ? Auth::user()->ukm->id : null;

        $gambar = $request->file('gambar')->store('galeri', 'public');

        Galeri::create([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar'    => $gambar,
            'ukm_id'    => $ukmId,
        ]);

        return redirect()
            ->route('admin-pengurus.galeri')
            ->with('success', 'Galeri berhasil ditambahkan');
    }

    public function edit($id)
    {
        $ukmId = Auth::user()->ukm ? Auth::user()->ukm->id : null;

        $galeri = Galeri::where('id', $id)
            ->where('ukm_id', $ukmId)
            ->firstOrFail();

        return view('admin_pengurus.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $ukmId = Auth::user()->ukm ? Auth::user()->ukm->id : null;

        $galeri = Galeri::where('id', $id)
            ->where('ukm_id', $ukmId)
            ->firstOrFail();

        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {

            if (
                $galeri->gambar &&
                Storage::disk('public')->exists($galeri->gambar)
            ) {
                Storage::disk('public')->delete($galeri->gambar);
            }

            $data['gambar'] = $request->file('gambar')
                ->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()
            ->route('admin-pengurus.galeri')
            ->with('success', 'Galeri berhasil diperbarui');
    }

    public function destroy($id)
    {
        $ukmId = Auth::user()->ukm ? Auth::user()->ukm->id : null;

        $galeri = Galeri::where('id', $id)
            ->where('ukm_id', $ukmId)
            ->firstOrFail();

        if (
            $galeri->gambar &&
            Storage::disk('public')->exists($galeri->gambar)
        ) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $galeri->delete();

        return redirect()
            ->route('admin-pengurus.galeri')
            ->with('success', 'Galeri berhasil dihapus');
    }
}
