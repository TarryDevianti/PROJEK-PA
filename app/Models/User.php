<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass Assignable
     */
    protected $fillable = [
        'name',
        'npm',
        'program_studi',
        'angkatan',
        'email',
        'telepon',
        'role',
        'is_active',
        'status_diterima',
        'ukm_id', // WAJIB DITAMBAHKAN
        'password',
        'password_plain',
    ];

    /**
     * Hidden Attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast Attributes
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke UKM
     */
    public function ukm()
    {
        return $this->belongsTo(Ukm::class, 'ukm_id');
    }

    /**
     * Relasi ke Galeri
     */
    public function galeris()
    {
        return $this->hasMany(Galeri::class, 'ukm_id', 'ukm_id');
    }

    /**
     * Set status otomatis saat registrasi
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {

            if (empty($user->status_diterima)) {
                $user->status_diterima = 'pending';
            }

        });
    }
}