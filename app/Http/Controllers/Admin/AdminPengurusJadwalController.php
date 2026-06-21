<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPengurusJadwalController extends Controller
{
    public function index()
    {
        $ukm = Auth::user()->ukm;

        $jadwal = Jadwal::where('ukm_slug', $ukm->slug)
            ->latest()
            ->get();

        return view('admin_pengurus.jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        return view('admin_pengurus.jadwal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'uraian' => 'required',
            'sesi_1_buka' => 'nullable|date',
            'sesi_1_tutup' => 'nullable|date',
            'sesi_2_buka' => 'nullable|date',
            'sesi_2_tutup' => 'nullable|date',
        ]);

        Jadwal::create([
            'ukm_slug' => Auth::user()->ukm->slug,
            'uraian' => $request->uraian,
            'sesi_1_buka' => $request->sesi_1_buka,
            'sesi_1_tutup' => $request->sesi_1_tutup,
            'sesi_2_buka' => $request->sesi_2_buka,
            'sesi_2_tutup' => $request->sesi_2_tutup,
        ]);

        return redirect()
            ->route('admin-pengurus.jadwal')
            ->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        return view('admin_pengurus.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'uraian' => 'required',
            'sesi_1_buka' => 'nullable|date',
            'sesi_1_tutup' => 'nullable|date',
            'sesi_2_buka' => 'nullable|date',
            'sesi_2_tutup' => 'nullable|date',
        ]);

        $jadwal->update([
            'uraian' => $request->uraian,
            'sesi_1_buka' => $request->sesi_1_buka,
            'sesi_1_tutup' => $request->sesi_1_tutup,
            'sesi_2_buka' => $request->sesi_2_buka,
            'sesi_2_tutup' => $request->sesi_2_tutup,
        ]);

        return redirect()
            ->route('admin-pengurus.jadwal')
            ->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy($id)
    {
        Jadwal::findOrFail($id)->delete();

        return redirect()
            ->route('admin-pengurus.jadwal')
            ->with('success', 'Jadwal berhasil dihapus');
    }
}