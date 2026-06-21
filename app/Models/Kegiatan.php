<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatans';

    protected $fillable = [
        'ukm_id',
        'judul',
        'deskripsi',
        'foto',
        'tanggal_kegiatan',
        'lokasi',
        'status',
        'views',
    ];
}