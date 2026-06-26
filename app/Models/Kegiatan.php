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

    public function ukm()
    {
        return $this->belongsTo(Ukm::class, 'ukm_id');
    }
}