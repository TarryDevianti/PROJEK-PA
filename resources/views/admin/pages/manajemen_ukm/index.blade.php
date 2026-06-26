@extends('admin.layouts.main')

@section('content')
<div class="container-fluid pt-4 px-4">

    <!-- Page Header -->
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0" style="color: #3d2c1e;">
                <i class="bi bi-building-fill me-2" style="color: #d4a373;"></i>
                Manajemen UKM
            </h4>
            <p class="text-muted small mb-0">Kelola data Unit Kegiatan Mahasiswa FMIPA</p>
        </div>
        <a href="{{ route('manajemen-ukm.create') }}" 
           class="btn rounded-pill px-4" 
           style="background: linear-gradient(135deg, #d4a373, #e9c46a); color: #3d2c1e; font-weight: 600; box-shadow: 0 4px 15px rgba(212, 163, 115, 0.3);">
            <i class="bi bi-plus-lg me-2"></i> Tambah UKM
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

    <!-- UKM Cards -->
    <div class="row g-4">
        @forelse ($ukms as $index => $ukm)
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 p-3" style="background: white; transition: all 0.3s ease;">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <!-- Left Side -->
                        <div class="d-flex align-items-center gap-4">
                            <span class="fw-bold text-muted" style="font-size: 1.2rem; min-width: 35px;">{{ $loop->iteration }}.</span>
                            
                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-light" 
                                 style="width: 70px; height: 70px; border: 3px solid rgba(212, 163, 115, 0.15); overflow: hidden;">
                                <img src="{{ $ukm->logo ? asset('storage/' . $ukm->logo) : asset('assets/img/default-logo.png') }}"
                                     alt="Logo {{ $ukm->nama_ukm }}"
                                     style="width: 100%; height: 100%; object-fit: cover; padding: 5px;">
                            </div>

                            <div>
                                <h5 class="fw-bold mb-1" style="color: #3d2c1e;">{{ $ukm->nama_ukm }}</h5>
                                <div class="d-flex flex-wrap gap-3">
                                    <small class="text-muted">
                                        <i class="bi bi-calendar-plus me-1"></i> Dibuat: {{ $ukm->created_at->format('d M Y') }}
                                    </small>
                                    <small class="text-muted">
                                        <i class="bi bi-arrow-repeat me-1"></i> Update: {{ $ukm->updated_at->format('d M Y') }}
                                    </small>
                                    <small class="text-muted">
                                        <i class="bi bi-person-badge me-1"></i> Admin: 
                                        @if($ukm->admin)
                                            {{ $ukm->admin->name }}
                                        @else
                                            <span class="text-warning">Belum ada admin</span>
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side -->
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <span class="badge rounded-pill px-3 py-2 {{ $ukm->status == 'aktif' ? 'bg-success' : 'bg-secondary' }}" 
                                  style="font-weight: 500; font-size: 0.7rem;">
                                <i class="bi {{ $ukm->status == 'aktif' ? 'bi-check-circle' : 'bi-x-circle' }} me-1"></i>
                                {{ strtoupper($ukm->status) }}
                            </span>
                            
                            <a href="{{ route('manajemen-ukm.edit', $ukm->id) }}" 
                               class="btn btn-sm rounded-pill px-3" 
                               style="background: rgba(212, 163, 115, 0.08); color: #d4a373; transition: all 0.3s ease;"
                               onmouseover="this.style.background='rgba(212, 163, 115, 0.15)'"
                               onmouseout="this.style.background='rgba(212, 163, 115, 0.08)'">
                                <i class="bi bi-pencil me-1"></i> Edit
                            </a>
                            
                            <form action="{{ route('manajemen-ukm.destroy', $ukm->id) }}" method="POST" class="d-inline" 
                                  onsubmit="return confirm('Yakin ingin menghapus UKM {{ $ukm->nama_ukm }}? Semua data terkait akan hilang.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm rounded-pill px-3" 
                                        style="background: rgba(220, 38, 38, 0.08); color: #dc2626; transition: all 0.3s ease;"
                                        onmouseover="this.style.background='rgba(220, 38, 38, 0.15)'"
                                        onmouseout="this.style.background='rgba(220, 38, 38, 0.08)'">
                                    <i class="bi bi-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 p-5 text-center" style="background: white;">
                    <div class="d-flex flex-column align-items-center">
                        <div class="rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: rgba(212, 163, 115, 0.08);">
                            <i class="bi bi-building" style="font-size: 2.5rem; color: #b8a89a;"></i>
                        </div>
                        <h6 class="fw-bold" style="color: #3d2c1e;">Belum ada UKM</h6>
                        <p class="text-muted small">Silakan tambahkan UKM baru dengan klik tombol di atas</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

</div>

<style>
    /* Hover effect for cards */
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 40px rgba(61, 44, 30, 0.08) !important;
        border-color: rgba(212, 163, 115, 0.1) !important;
    }
</style>
@endsection