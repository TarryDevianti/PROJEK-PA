<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
        'ukm_slug',
        'uraian',
        'sesi_1_buka',
        'sesi_1_tutup',
        'sesi_2_buka',
        'sesi_2_tutup'
    ];

    public $timestamps = true;

    public function ukm()
{
    return $this->belongsTo(\App\Models\Ukm::class, 'ukm_slug', 'slug');
}
}