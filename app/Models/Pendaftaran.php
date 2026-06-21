<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'name',
        'npm',
        'prodi',
        'email',
        'no_telepon',
        'angkatan',
        'ukm_tujuan',
        'divisi_tujuan',
        'alasan',
        'alamat',
        'foto',
        'status',
        'catatan_admin',

        // Tambahan
        'no_anggota',
        'jabatan'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ukm()
    {
        return $this->belongsTo(Ukm::class);
    }
}