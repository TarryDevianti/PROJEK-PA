<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukm extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_ukm',
        'slug',
        'deskripsi',
        'logo',
        'link_grup',   // Tambahan untuk menyimpan link grup WhatsApp
        'status',
        'user_id'
    ];

    // ==========================================
    // RELASI KE USER (ADMIN PENGURUS)
    // ==========================================
    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ==========================================
    // RELASI KE JADWAL
    // ==========================================
    public function jadwal()
    {
        return $this->hasOne(Jadwal::class, 'ukm_slug', 'slug');
    }

    // ==========================================
    // RELASI KE PENGURUS
    // ==========================================
    public function pengurus()
    {
        return $this->hasMany(Pengurus::class, 'ukm_slug', 'slug');
    }

    // ==========================================
    // RELASI KE PENDAFTARAN
    // ==========================================
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'ukm_tujuan', 'slug');
    }

    // ==========================================
    // RELASI KE KEGIATAN
    // ==========================================
    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class, 'ukm_id', 'id');
    }

    // ==========================================
    // RELASI KE GALERI
    // ==========================================
    public function galeris()
    {
        return $this->hasMany(Galeri::class, 'ukm_id', 'id');
    }

    // ==========================================
    // RELASI KE ANGGOTA (USER)
    // ==========================================
    public function anggota()
    {
        return $this->hasMany(User::class, 'ukm_id', 'id');
    }

    // ==========================================
    // ACCESSOR: GET LINK GRUP (DENGAN DEFAULT)
    // ==========================================
    public function getLinkGrupAttribute($value)
    {
        return $value ?? null;
    }

    // ==========================================
    // MUTATOR: SET LINK GRUP (TRIM)
    // ==========================================
    public function setLinkGrupAttribute($value)
    {
        $this->attributes['link_grup'] = $value ? trim($value) : null;
    }

    // ==========================================
    // CEK APAKAH UKM PUNYA LINK GRUP
    // ==========================================
    public function hasLinkGrup(): bool
    {
        return !empty($this->link_grup);
    }

    // ==========================================
    // GET LINK GRUP ATAU DEFAULT (BERANDA)
    // ==========================================
    public function getLinkGrupOrDefault()
    {
        return $this->link_grup ?? route('beranda');
    }

    public function galeri()
    {
        return $this->hasMany(Galeri::class)->latest();
    }

    public function getLogoUrlAttribute()
    {
        // Jika logo hanya nama file, tambahkan path
        if ($this->logo && !str_contains($this->logo, 'assets/')) {
            return 'assets/img/' . $this->logo;
        }
        return $this->logo;
    }
}