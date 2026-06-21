<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPengurusKontakController extends Controller
{
    public function index()
    {
        $kontak = Kontak::where(
            'ukm_id',
            Auth::user()->ukm_id
        )->first();

        return view(
            'admin_pengurus.kontak.index',
            compact('kontak')
        );
    }

    public function create()
    {
        return view('admin_pengurus.kontak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'link_grup' => 'required'
        ]);

        Kontak::create([
            'ukm_id' => Auth::user()->ukm_id,
            'link_grup' => $request->link_grup
        ]);

        return redirect()
            ->route('admin-pengurus.kontak')
            ->with('success', 'Link grup berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kontak = Kontak::findOrFail($id);

        return view(
            'admin_pengurus.kontak.edit',
            compact('kontak')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'link_grup' => 'required'
        ]);

        $kontak = Kontak::findOrFail($id);

        $kontak->update([
            'link_grup' => $request->link_grup
        ]);

        return redirect()
            ->route('admin-pengurus.kontak')
            ->with('success', 'Link grup berhasil diupdate');
    }

    public function destroy($id)
    {
        Kontak::findOrFail($id)->delete();

        return back()->with(
            'success',
            'Link grup berhasil dihapus'
        );
    }
}