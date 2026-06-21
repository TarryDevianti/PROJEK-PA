<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukm extends Model
{
    use HasFactory;

    protected $table = 'ukms';

    protected $fillable = [
        'nama_ukm',
        'slug',
        'logo',
        'deskripsi'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function jadwal()
    {
        return $this->hasOne(
            \App\Models\Jadwal::class,
            'ukm_slug',
            'slug'
        );
    }

    // TAMBAHKAN INI
   public function kontak()
{
    return $this->hasOne(\App\Models\Kontak::class);
}

public function galeris()
{
    return $this->hasMany(Galeri::class, 'ukm_id');
}
}