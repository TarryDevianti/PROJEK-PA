<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Ukm;

class KegiatanController extends Controller
{
   public function index(string $slug)
{
    $ukm = Ukm::where('slug', $slug)->firstOrFail();

    $kegiatan = Kegiatan::where('ukm_id', $ukm->id)
        ->latest()
        ->get();

    return view(
        'admin.pages.kegiatan.index',
        compact('ukm', 'kegiatan')
    );
}

public function show(string $slug, int $id)
{
    $ukm = Ukm::where('slug', $slug)->firstOrFail();

    $kegiatan = Kegiatan::findOrFail($id);

    return view(
        'admin.pages.kegiatan.show',
        compact('ukm', 'kegiatan')
    );
}
}