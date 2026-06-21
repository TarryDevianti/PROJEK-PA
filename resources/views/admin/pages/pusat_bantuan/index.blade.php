@extends('admin.layouts.main')

@section('content')
<div class="container-fluid pt-4 px-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div class="d-flex align-items-center gap-3">
            <h3 class="fw-bold text-uppercase bg-secondary text-white px-5 py-2 rounded-pill mb-0 shadow-sm" style="letter-spacing: 1px;">
                Pusat Bantuan & FAQ
            </h3>
            <!-- Tombol Tambah (Icon Plus) -->
            <button class="btn btn-dark rounded-circle d-flex align-items-center justify-content-center shadow-sm" 
                    style="width: 40px; height: 40px;" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg fs-5"></i>
            </button>
            <i class="bi bi-pencil-square fs-4 text-dark ms-2"></i>
        </div>

        <!-- Search Bar -->
        <form action="{{ route('pusat-bantuan.index') }}" method="GET" class="position-relative">
            <input type="text" name="search" class="form-control rounded-pill ps-4 shadow-sm" 
                   placeholder="Cari bantuan..." value="{{ request('search') }}" 
                   style="width: 250px; background-color: #d9d9d9; border: none;">
            <button type="submit" class="btn position-absolute end-0 top-50 translate-middle-y me-2 border-0 bg-transparent">
                <i class="bi bi-search text-dark fs-5"></i>
            </button>
        </form>
    </div>

    <!-- FAQ List -->
    <div class="faq-container">
        @foreach($faqs as $faq)
        <div class="mb-5 position-relative group-action">
            <div class="d-flex align-items-center gap-3 mb-2">
                <h4 class="fw-bold mb-0">{{ $faq->pertanyaan }}</h4>
                <span class="badge bg-light text-dark border px-3 py-1 fw-bold" style="background-color: #e0e0e0 !important;">
                    {{ $faq->kategori }}
                </span>
                
                <!-- Action Buttons (Muncul saat hover atau klik) -->
                <div class="ms-auto d-flex gap-2">
                    <button class="btn btn-sm btn-outline-primary border-0" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $faq->id }}">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <form action="{{ route('pusat-bantuan.destroy', $faq->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Hapus FAQ ini?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            <p class="text-secondary fs-5" style="line-height: 1.6; max-width: 80%;">
                {{ $faq->jawaban }}
            </p>
            @if(!$loop->last) <hr class="my-4"> @endif
        </div>
        @include('admin.pages.pusat_bantuan.edit')
        @endforeach
    </div>
</div>

@include('admin.pages.pusat_bantuan.create')

@endsection