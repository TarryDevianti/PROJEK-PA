@extends('layouts.app')

@section('title', 'Galeri UKM Saya')

@section('content')
<div class="container">
    <h2 class="mb-4" style="color: #3d2c1e;">
        <i class="bi bi-images me-2"></i> Galeri UKM Saya
    </h2>

    @if($galeris->count())
        <div class="row">
            @foreach($galeris as $galeri)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card card-shadow h-100">
                        @if($galeri->gambar)
                            <img src="{{ asset('storage/' . $galeri->gambar) }}" 
                                 class="card-img-top" 
                                 alt="{{ $galeri->judul ?? 'Galeri' }}"
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-light text-center py-5" style="height: 200px;">
                                <i class="bi bi-image" style="font-size: 3rem; color: #ccc;"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title" style="color: #3d2c1e;">{{ $galeri->judul ?? 'Tanpa judul' }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($galeri->deskripsi ?? '', 80) }}</p>
                            <p class="card-text text-muted small">
                                <i class="bi bi-building me-1"></i> {{ $galeri->ukm->nama_ukm ?? 'UKM tidak diketahui' }}
                            </p>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalGaleri{{ $galeri->id }}">
                                <i class="bi bi-eye me-1"></i> Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalGaleri{{ $galeri->id }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $galeri->judul ?? 'Detail Galeri' }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-center">
                                @if($galeri->gambar)
                                    <img src="{{ asset('storage/' . $galeri->gambar) }}" class="img-fluid rounded mb-3" alt="{{ $galeri->judul }}" style="max-height: 400px; object-fit: contain;">
                                @endif
                                <p><strong>UKM:</strong> {{ $galeri->ukm->nama_ukm ?? '-' }}</p>
                                @if($galeri->deskripsi)
                                    <p><strong>Deskripsi:</strong></p>
                                    <p>{{ $galeri->deskripsi }}</p>
                                @endif
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
            <i class="bi bi-info-circle me-2"></i> Belum ada galeri untuk UKM Anda.
        </div>
    @endif
</div>
@endsection