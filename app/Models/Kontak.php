<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $fillable = [
        'ukm_id',
        'link_grup'
    ];

    public function ukm()
    {
        return $this->belongsTo(Ukm::class);
    }
}