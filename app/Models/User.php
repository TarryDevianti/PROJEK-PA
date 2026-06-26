<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
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
        'ukm_id',
        'password',
        'password_plain',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Boot method untuk event model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->status_diterima)) {
                $user->status_diterima = 'pending';
            }
            
            // Set default is_active jika belum diisi
            if (!isset($user->is_active)) {
                $user->is_active = true;
            }
        });
    }

    // ==========================================
    // MUTATORS & ACCESSORS
    // ==========================================

    /**
     * Set NPM attribute (bisa ditambahkan validasi)
     */
    public function setNpmAttribute($value)
    {
        $this->attributes['npm'] = trim($value);
    }

    /**
     * Get kode fakultas dari NPM (2 digit setelah tahun)
     * Contoh: 2308001010033 -> 08
     */
    public function getKodeFakultasAttribute()
    {
        if (strlen($this->npm) >= 4) {
            return substr($this->npm, 2, 2);
        }
        return null;
    }

    /**
     * Get tahun masuk dari NPM (2 digit pertama)
     * Contoh: 2308001010033 -> 23
     */
    public function getTahunMasukAttribute()
    {
        if (strlen($this->npm) >= 2) {
            return substr($this->npm, 0, 2);
        }
        return null;
    }

    /**
     * Get nomor urut dari NPM (6 digit terakhir)
     * Contoh: 2308001010033 -> 1010033
     */
    public function getNomorUrutAttribute()
    {
        if (strlen($this->npm) >= 6) {
            return substr($this->npm, 4);
        }
        return null;
    }

    /**
     * Get format NPM lengkap dengan keterangan
     */
    public function getNpmFormattedAttribute()
    {
        $tahun = $this->tahun_masuk;
        $fakultas = $this->kode_fakultas;
        $nomor = $this->nomor_urut;
        
        if ($tahun && $fakultas && $nomor) {
            return "{$tahun}-{$fakultas}-{$nomor}";
        }
        return $this->npm;
    }

    /**
     * Get nama role yang lebih mudah dibaca
     */
    public function getRoleLabelAttribute()
    {
        $roles = [
            'super_admin' => 'Super Admin',
            'admin_seramoe' => 'Admin Seramoe',
            'admin_ulul_albab' => 'Admin Ulul Albab',
            'admin_barracuda' => 'Admin Barracuda',
            'anggota' => 'Anggota',
        ];
        
        return $roles[$this->role] ?? ucfirst($this->role);
    }

    /**
     * Get status diterima label
     */
    public function getStatusDiterimaLabelAttribute()
    {
        $statuses = [
            'pending' => 'Menunggu',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak',
        ];
        
        return $statuses[$this->status_diterima] ?? ucfirst($this->status_diterima);
    }

    /**
     * Get badge status untuk UI
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'warning',
            'diterima' => 'success',
            'ditolak' => 'danger',
        ];
        
        return $badges[$this->status_diterima] ?? 'secondary';
    }

    /**
     * Get initials dari nama (untuk avatar)
     * Contoh: "Denny Evanel" -> "DE"
     */
    public function getInitialsAttribute()
    {
        $words = explode(' ', trim($this->name));
        $initials = '';
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper($word[0]);
            }
        }
        return $initials ?: 'U';
    }

    // ==========================================
    // VALIDATION HELPERS
    // ==========================================

    /**
     * Cek apakah user adalah mahasiswa FMIPA (kode fakultas 08)
     */
    public function isFmipa(): bool
    {
        return $this->kode_fakultas === '08';
    }

    /**
     * Cek apakah user adalah anggota
     */
    public function isAnggota(): bool
    {
        return $this->role === 'anggota';
    }

    /**
     * Cek apakah user adalah admin pengurus
     */
    public function isAdminPengurus(): bool
    {
        return in_array($this->role, [
            'admin_seramoe',
            'admin_ulul_albab',
            'admin_barracuda'
        ]);
    }

    /**
     * Cek apakah user adalah super admin
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * Cek apakah user adalah admin (super admin atau admin pengurus)
     */
    public function isAdmin(): bool
    {
        return $this->isSuperAdmin() || $this->isAdminPengurus();
    }

    /**
     * Cek apakah user bisa login (aktif dan tidak diblokir)
     */
    public function canLogin(): bool
    {
        return $this->is_active === true;
    }

    /**
     * Cek apakah user diterima sebagai anggota
     */
    public function isAccepted(): bool
    {
        return $this->status_diterima === 'diterima';
    }

    /**
     * Cek apakah user masih pending
     */
    public function isPending(): bool
    {
        return $this->status_diterima === 'pending';
    }

    /**
     * Validasi NPM format dan kode fakultas untuk anggota
     */
    public function validateNpmForAnggota(): array
    {
        $result = [
            'valid' => false,
            'message' => '',
            'kode_fakultas' => null,
            'tahun_masuk' => null,
        ];

        // Cek panjang NPM minimal 4 digit
        if (strlen($this->npm) < 4) {
            $result['message'] = 'Format NPM tidak valid. Minimal 4 digit.';
            return $result;
        }

        $result['tahun_masuk'] = $this->tahun_masuk;
        $result['kode_fakultas'] = $this->kode_fakultas;

        // Cek apakah kode fakultas 08 (FMIPA)
        if ($this->kode_fakultas === '08') {
            $result['valid'] = true;
            $result['message'] = 'NPM valid untuk mahasiswa FMIPA.';
        } else {
            $result['message'] = 'Maaf, hanya mahasiswa FMIPA (kode fakultas 08) yang dapat mendaftar.';
        }

        return $result;
    }

    // ==========================================
    // SCOPES
    // ==========================================

    /**
     * Scope untuk filter user aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk filter user non-aktif
     */
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    /**
     * Scope untuk filter anggota
     */
    public function scopeAnggota($query)
    {
        return $query->where('role', 'anggota');
    }

    /**
     * Scope untuk filter admin pengurus
     */
    public function scopeAdminPengurus($query)
    {
        return $query->whereIn('role', [
            'admin_seramoe',
            'admin_ulul_albab',
            'admin_barracuda'
        ]);
    }

    /**
     * Scope untuk filter super admin
     */
    public function scopeSuperAdmin($query)
    {
        return $query->where('role', 'super_admin');
    }

    /**
     * Scope untuk filter user FMIPA (kode fakultas 08)
     */
    public function scopeFmipa($query)
    {
        return $query->whereRaw("SUBSTRING(npm, 3, 2) = '08'");
    }

    /**
     * Scope untuk filter user berdasarkan status diterima
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status_diterima', $status);
    }

    /**
     * Scope untuk filter user berdasarkan UKM
     */
    public function scopeByUkm($query, $ukmId)
    {
        return $query->where('ukm_id', $ukmId);
    }

    // ==========================================
    // RELATIONSHIPS
    // ==========================================

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
     * Relasi ke Pendaftaran (jika ada)
     */
    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class);
    }

    /**
     * Relasi ke Kegiatan (jika user adalah pembuat kegiatan)
     */
    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class, 'created_by');
    }

    // ==========================================
    // ADDITIONAL HELPERS
    // ==========================================

    /**
     * Get UKM name jika user memiliki UKM
     */
    public function getUkmNameAttribute()
    {
        return $this->ukm ? $this->ukm->name : null;
    }

    /**
     * Get UKM slug jika user memiliki UKM
     */
    public function getUkmSlugAttribute()
    {
        return $this->ukm ? $this->ukm->slug : null;
    }

    /**
     * Check if user has UKM
     */
    public function hasUkm(): bool
    {
        return $this->ukm_id !== null && $this->ukm !== null;
    }

    /**
     * Get dashboard route berdasarkan role
     */
    public function getDashboardRouteAttribute()
    {
        if ($this->isSuperAdmin()) {
            return route('admin.dashboard');
        }
        
        if ($this->isAdminPengurus()) {
            return route('admin-pengurus.dashboard');
        }
        
        if ($this->isAnggota()) {
            return route('dashboard');
        }
        
        return '/';
    }

    /**
     * Get redirect after login berdasarkan role
     */
    public function getRedirectAfterLoginAttribute()
    {
        return $this->dashboard_route;
    }

    /**
     * Format nama lengkap dengan gelar (opsional)
     */
    public function getFullNameAttribute()
    {
        return $this->name;
    }

    /**
     * Cek apakah user bisa mengakses UKM tertentu
     */
    public function canAccessUkm($ukmId): bool
    {
        // Super admin bisa akses semua
        if ($this->isSuperAdmin()) {
            return true;
        }
        
        // Admin pengurus hanya bisa akses UKM miliknya
        if ($this->isAdminPengurus()) {
            return $this->ukm_id === $ukmId;
        }
        
        // Anggota hanya bisa akses UKM miliknya
        if ($this->isAnggota()) {
            return $this->ukm_id === $ukmId;
        }
        
        return false;
    }

    /**
     * Cek apakah user adalah admin dari UKM tertentu
     */
    public function isAdminOfUkm($ukmId): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }
        
        if ($this->isAdminPengurus()) {
            return $this->ukm_id === $ukmId;
        }
        
        return false;
    }

    public function pengurus()
{
    return $this->hasMany(Pengurus::class, 'user_id');
}
}