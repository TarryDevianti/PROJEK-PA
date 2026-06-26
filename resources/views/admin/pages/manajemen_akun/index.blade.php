@extends('admin.layouts.main')

@section('content')
<div class="container-fluid pt-4">

    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0" style="color: #3d2c1e;">
                <i class="bi bi-people-fill me-2" style="color: #d4a373;"></i>
                Pusat Kendali Akun Pengguna
            </h4>
            <p class="text-muted small mb-0">Kelola akun anggota UKM FMIPA</p>
        </div>
        <a href="{{ route('manajemen-akun.create') }}" 
           class="btn rounded-pill px-4" 
           style="background: linear-gradient(135deg, #d4a373, #e9c46a); color: #3d2c1e; font-weight: 600; box-shadow: 0 4px 15px rgba(212, 163, 115, 0.3);">
            <i class="bi bi-plus-lg me-2"></i> Tambah Akun
        </a>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert alert-success border-0 rounded-4 shadow-sm d-flex align-items-center" role="alert" style="background: rgba(82, 183, 136, 0.1); color: #2d6a4f; border-left: 4px solid #52b788;">
            <i class="bi bi-check-circle-fill me-3" style="font-size: 1.2rem;"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 rounded-4 shadow-sm d-flex align-items-center" role="alert" style="background: rgba(220, 38, 38, 0.08); color: #dc2626; border-left: 4px solid #dc2626;">
            <i class="bi bi-exclamation-triangle-fill me-3" style="font-size: 1.2rem;"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filter UKM - DINAMIS dengan Tombol Semua UKM -->
    <div class="d-flex flex-wrap gap-2 mb-3">
        {{-- Tombol Semua UKM --}}
        <a href="{{ route('manajemen-akun.index', ['all' => true]) }}" 
           class="btn rounded-pill px-4 py-2 {{ request()->has('all') ? 'text-white' : 'text-muted' }}" 
           style="{{ request()->has('all') ? 'background: linear-gradient(135deg, #d4a373, #e9c46a); color: #3d2c1e; font-weight: 600;' : 'background: rgba(212, 163, 115, 0.08); border: 1px solid rgba(212, 163, 115, 0.15);' }}">
            <i class="bi bi-grid me-1"></i> Semua UKM
        </a>

        @forelse($ukms as $ukm)
            <a href="{{ route('manajemen-akun.index', ['ukm' => $ukm->nama_ukm]) }}" 
               class="btn rounded-pill px-4 py-2 {{ $activeUkm == $ukm->nama_ukm && !request()->has('all') ? 'text-white' : 'text-muted' }}" 
               style="{{ $activeUkm == $ukm->nama_ukm && !request()->has('all') ? 'background: linear-gradient(135deg, #d4a373, #e9c46a); color: #3d2c1e; font-weight: 600;' : 'background: rgba(212, 163, 115, 0.08); border: 1px solid rgba(212, 163, 115, 0.15);' }}">
                <i class="bi bi-building me-1"></i> {{ $ukm->nama_ukm }}
            </a>
        @empty
            <p class="text-muted small">Belum ada UKM yang terdaftar.</p>
        @endforelse
    </div>

    <!-- Search Bar -->
    <div class="d-flex justify-content-end mb-3">
        <form action="{{ route('manajemen-akun.index') }}" method="GET" class="d-flex" style="max-width: 320px; width: 100%;">
            @if(request()->has('all'))
                <input type="hidden" name="all" value="true">
            @else
                <input type="hidden" name="ukm" value="{{ $activeUkm }}">
            @endif
            <div class="input-group rounded-pill shadow-sm" style="overflow: hidden; background: white; border: 1px solid rgba(212, 163, 115, 0.15);">
                <span class="input-group-text border-0 bg-transparent" style="padding-left: 16px;">
                    <i class="bi bi-search text-muted"></i>
                </span>
                <input type="text" name="search" class="form-control border-0 bg-transparent py-2" placeholder="Cari akun..." value="{{ request('search') }}" style="font-size: 0.9rem;">
                <button class="btn border-0 bg-transparent px-3" type="submit" style="color: #d4a373;">
                    <i class="bi bi-arrow-right-circle-fill"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Table Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background: rgba(212, 163, 115, 0.06);">
                        <tr>
                            <th width="5%" class="py-3 ps-4 text-muted fw-semibold" style="border-radius: 12px 0 0 0;">No</th>
                            <th class="text-start ps-4 text-muted fw-semibold py-3" width="20%">Nama</th>
                            <th class="text-muted fw-semibold py-3" width="12%">NPM</th>
                            <th class="text-muted fw-semibold py-3" width="12%">Role</th>
                            <th class="text-muted fw-semibold py-3" width="15%">UKM</th>
                            <th class="text-muted fw-semibold py-3" width="15%">Password</th>
                            <th class="text-muted fw-semibold py-3 text-center" style="border-radius: 0 12px 0 0;" width="21%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                        <tr class="border-bottom {{ !$user->is_active ? 'opacity-50' : '' }}" style="transition: all 0.3s ease;">
                            <td class="ps-4 fw-semibold text-muted">{{ $users->firstItem() + $loop->index }}</td>
                            <td class="text-start ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: rgba(212, 163, 115, 0.12);">
                                        <i class="bi bi-person-fill" style="color: #d4a373;"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold" style="color: #3d2c1e;">{{ $user->name }}</div>
                                        <small class="text-muted">{{ $user->email ?? '-' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge rounded-pill px-3 py-2" style="background: rgba(212, 163, 115, 0.08); color: #8a7a6a; font-weight: 500; font-family: monospace;">
                                    {{ $user->npm ?? '-' }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $roleLabels = [
                                        'super_admin' => 'Super Admin',
                                        'admin_seramoe' => 'Admin Seuramoe',
                                        'admin_ulul_albab' => 'Admin Ulul Albab',
                                        'admin_barracuda' => 'Admin Barracuda',
                                        'anggota' => 'Anggota'
                                    ];
                                    $roleColors = [
                                        'super_admin' => '#ef4444',
                                        'admin_seramoe' => '#d4a373',
                                        'admin_ulul_albab' => '#b388ff',
                                        'admin_barracuda' => '#52b788',
                                        'anggota' => '#6c757d'
                                    ];
                                    $roleColor = $roleColors[$user->role] ?? '#6c757d';
                                    $roleLabel = $roleLabels[$user->role] ?? ucfirst($user->role);
                                @endphp
                                <span class="badge rounded-pill px-3 py-2" style="background: {{ $roleColor }}15; color: {{ $roleColor }}; font-weight: 500; border: 1px solid {{ $roleColor }}25;">
                                    {{ $roleLabel }}
                                </span>
                            </td>
                            <td>
                                @if($user->ukm)
                                    <span class="badge rounded-pill px-3 py-2" style="background: rgba(212, 163, 115, 0.08); color: #8a7a6a; font-weight: 500;">
                                        {{ $user->ukm->nama_ukm }}
                                    </span>
                                @else
                                    <span class="badge rounded-pill px-3 py-2" style="background: rgba(220, 38, 38, 0.08); color: #dc2626; font-weight: 500;">
                                        <i class="bi bi-exclamation-circle me-1"></i> Belum ada UKM
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="input-group input-group-sm mx-auto shadow-sm rounded-pill" style="max-width: 150px; overflow: hidden; background: white; border: 1px solid rgba(212, 163, 115, 0.15);">
                                    <input type="password" 
                                           class="form-control text-center border-0 bg-transparent password-field font-monospace fw-bold" 
                                           value="{{ $user->password_plain ?? 'Belum di-set' }}" 
                                           readonly 
                                           style="font-size: 0.8rem; letter-spacing: 1px; color: #3d2c1e; padding: 6px 8px;">
                                    <button class="btn border-0 bg-transparent toggle-password-btn" type="button" title="Lihat Password" style="padding: 6px 10px;">
                                        <i class="bi bi-eye-slash text-muted" style="font-size: 0.9rem;"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <!-- Reset Password -->
                                    <form action="{{ route('manajemen-akun.reset', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset password akun {{ $user->name }}?')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm rounded-pill px-3" style="background: rgba(244, 162, 97, 0.1); color: #f4a261; transition: all 0.3s ease; border: none; font-weight: 600; font-size: 0.7rem;"
                                                onmouseover="this.style.background='rgba(244, 162, 97, 0.2)'"
                                                onmouseout="this.style.background='rgba(244, 162, 97, 0.1)'">
                                            <i class="bi bi-arrow-clockwise me-1"></i> Reset
                                        </button>
                                    </form>

                                    <!-- Edit -->
                                    <a href="{{ route('manajemen-akun.edit', $user->id) }}" 
                                       class="btn btn-sm rounded-pill px-3" 
                                       style="background: rgba(212, 163, 115, 0.1); color: #d4a373; transition: all 0.3s ease; font-weight: 600; font-size: 0.7rem;"
                                       onmouseover="this.style.background='rgba(212, 163, 115, 0.2)'"
                                       onmouseout="this.style.background='rgba(212, 163, 115, 0.1)'">
                                        <i class="bi bi-pencil me-1"></i> Edit
                                    </a>

                                    <!-- Blokir / Buka -->
                                    <form action="{{ route('manajemen-akun.blokir', $user->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" 
                                                class="btn btn-sm rounded-pill px-3" 
                                                style="{{ $user->is_active ? 'background: rgba(220, 38, 38, 0.08); color: #dc2626;' : 'background: rgba(82, 183, 136, 0.08); color: #2d6a4f;' }} transition: all 0.3s ease; font-weight: 600; font-size: 0.7rem; border: none;"
                                                onmouseover="this.style.background='{{ $user->is_active ? 'rgba(220, 38, 38, 0.15)' : 'rgba(82, 183, 136, 0.15)' }}'"
                                                onmouseout="this.style.background='{{ $user->is_active ? 'rgba(220, 38, 38, 0.08)' : 'rgba(82, 183, 136, 0.08)' }}'">
                                            <i class="bi {{ $user->is_active ? 'bi-lock' : 'bi-unlock' }} me-1"></i>
                                            {{ $user->is_active ? 'Blokir' : 'Buka' }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: rgba(212, 163, 115, 0.08);">
                                        <i class="bi bi-people" style="font-size: 2.5rem; color: #b8a89a;"></i>
                                    </div>
                                    <h6 class="fw-bold" style="color: #3d2c1e;">Tidak ada data akun</h6>
                                    <p class="text-muted small">Belum ada akun pengguna untuk kategori ini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator && $users->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-4">
        <p class="text-muted small mb-0">
            Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} data
        </p>
        <nav>
            <ul class="pagination pagination-sm mb-0">
                {{ $users->links('pagination::bootstrap-5') }}
            </ul>
        </nav>
    </div>
    @endif

</div>

<!-- Toggle Password Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.toggle-password-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var inputField = this.parentElement.querySelector('.password-field');
                var iconElement = this.querySelector('i');
                
                if (inputField.type === 'password') {
                    inputField.type = 'text';
                    iconElement.classList.remove('bi-eye-slash');
                    iconElement.classList.add('bi-eye');
                    iconElement.classList.remove('text-muted');
                    iconElement.classList.add('text-primary');
                } else {
                    inputField.type = 'password';
                    iconElement.classList.remove('bi-eye');
                    iconElement.classList.add('bi-eye-slash');
                    iconElement.classList.remove('text-primary');
                    iconElement.classList.add('text-muted');
                }
            });
        });
    });
</script>

<style>
    .pagination .page-item .page-link {
        color: #8a7a6a;
        border: none;
        padding: 6px 14px;
        border-radius: 8px;
        margin: 0 2px;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #d4a373, #e9c46a);
        color: #3d2c1e;
        box-shadow: 0 4px 15px rgba(212, 163, 115, 0.3);
    }

    .pagination .page-item .page-link:hover:not(.active) {
        background: rgba(212, 163, 115, 0.08);
        color: #3d2c1e;
    }

    .table-hover tbody tr:hover {
        background: rgba(212, 163, 115, 0.03);
    }

    .btn-close {
        filter: opacity(0.5);
    }
    .btn-close:hover {
        filter: opacity(1);
    }
</style>
@endsection