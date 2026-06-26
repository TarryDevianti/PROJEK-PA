@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card card-shadow">
            <div class="card-header bg-transparent border-0 pt-4">
                <h4 class="fw-bold mb-0" style="color: #3d2c1e;">
                    <i class="bi bi-person-circle me-2" style="color: #d4a373;"></i>
                    Status Pendaftaran UKM Kamu
                </h4>
            </div>
            <div class="card-body p-4">
                <!-- Informasi User -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: rgba(212, 163, 115, 0.1);">
                                <i class="bi bi-person-fill" style="font-size: 2rem; color: #d4a373;"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0">{{ auth()->user()->name }}</h5>
                                <p class="text-muted mb-0">{{ auth()->user()->npm }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row g-2">
                            <div class="col-6">
                                <small class="text-muted d-block">Program Studi</small>
                                <span class="fw-semibold">{{ auth()->user()->program_studi }}</span>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Angkatan</small>
                                <span class="fw-semibold">{{ auth()->user()->angkatan }}</span>
                            </div>
                            <div class="col-12">
                                <small class="text-muted d-block">No. Telepon</small>
                                <span class="fw-semibold">{{ auth()->user()->telepon ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Status Pendaftaran -->
                <div class="text-center py-4">
                    @if($pendaftaran)
                        <div class="mb-3">
                            <div class="badge bg-success rounded-pill px-4 py-2 fs-6">
                                <i class="bi bi-check-circle-fill me-2"></i> Anda sudah mendaftar
                            </div>
                            <p class="mt-3 text-muted">
                                Anda telah mendaftar di <strong>{{ $pendaftaran->ukm->nama_ukm ?? 'UKM' }}</strong>
                                dengan status: 
                                <span class="badge {{ $pendaftaran->status == 'diterima' ? 'bg-success' : ($pendaftaran->status == 'ditolak' ? 'bg-danger' : 'bg-warning') }}">
                                    {{ ucfirst($pendaftaran->status) }}
                                </span>
                            </p>
                        </div>
                    @else
                        <div class="mb-3">
                            <div class="badge bg-secondary rounded-pill px-4 py-2 fs-6">
                                <i class="bi bi-clock me-2"></i> Kamu Belum Mendaftar
                            </div>
                            <p class="mt-3 text-muted">
                                Silakan pilih dan ikuti organisasi mahasiswa di lingkungan FMIPA USK 
                                dengan mengisi formulir pendaftaran.
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Tombol Aksi -->
                <div class="text-center mt-3">
                    @if(!$pendaftaran)
                        <a href="{{ url('/pilih-ukm') }}" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm" 
                           style="background: linear-gradient(135deg, #d4a373, #e9c46a); color: #3d2c1e; font-weight: 600; border: none;">
                            <i class="bi bi-pencil-square me-2"></i> Mulai Isi Formulir Pendaftaran
                        </a>
                    @else
                        <a href="{{ route('beranda') }}" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="bi bi-house me-2"></i> Kembali ke Beranda
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection