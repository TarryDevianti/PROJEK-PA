@extends('layouts.app')

@section('title', 'Kegiatan UKM Saya')

@section('content')
<div class="container">
    <h2 class="mb-4" style="color: #3d2c1e;">
        <i class="bi bi-calendar-event me-2"></i> Kegiatan UKM Saya
    </h2>

    @if($kegiatans->count())
        <div class="row">
            @foreach($kegiatans as $kegiatan)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card card-shadow h-100">
                        @if($kegiatan->foto)
                            <img src="{{ asset('storage/' . $kegiatan->foto) }}" 
                                 class="card-img-top" 
                                 alt="{{ $kegiatan->judul }}"
                                 style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title" style="color: #3d2c1e;">{{ $kegiatan->judul }}</h5>
                            <p class="card-text text-muted small">
                                <i class="bi bi-building me-1"></i> {{ $kegiatan->ukm->nama_ukm ?? 'UKM tidak diketahui' }}
                            </p>
                            <p class="card-text">{{ Str::limit($kegiatan->deskripsi ?? '', 100) }}</p>
                            <p class="card-text">
                                <i class="bi bi-geo-alt me-1"></i> {{ $kegiatan->lokasi ?? 'Lokasi tidak tersedia' }}
                            </p>
                            <p class="card-text">
                                <i class="bi bi-calendar3 me-1"></i> 
                                {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d F Y') }}
                            </p>
                            <!-- Tombol untuk membuka modal -->
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalKegiatan{{ $kegiatan->id }}">
                                <i class="bi bi-eye me-1"></i> Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalKegiatan{{ $kegiatan->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $kegiatan->judul }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                @if($kegiatan->foto)
                                    <img src="{{ asset('storage/' . $kegiatan->foto) }}" class="img-fluid rounded mb-3" alt="{{ $kegiatan->judul }}">
                                @endif
                                <p><strong>UKM:</strong> {{ $kegiatan->ukm->nama_ukm ?? '-' }}</p>
                                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d F Y') }}</p>
                                <p><strong>Lokasi:</strong> {{ $kegiatan->lokasi ?? '-' }}</p>
                                <p><strong>Deskripsi:</strong></p>
                                <p>{{ $kegiatan->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle me-2"></i> Belum ada kegiatan untuk UKM Anda.
        </div>
    @endif
</div>
@endsection