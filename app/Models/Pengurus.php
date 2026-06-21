<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;

    protected $table = 'pengurus';

    protected $fillable = [
        'user_id',
        'nama',
        'jabatan',
        'periode',
        'foto',
        'deskripsi',
        'urutan',
        'is_active',
        'ukm_slug'
    ];

    /**
     * Relasi ke model UKM
     * Menggunakan ukm_slug sebagai kunci penghubung
     */
    public function ukm()
    {
        // Sesuaikan 'slug' dengan nama kolom primary key di tabel UKM Anda jika berbeda
        return $this->belongsTo(Ukm::class, 'ukm_slug', 'slug');
    }
}