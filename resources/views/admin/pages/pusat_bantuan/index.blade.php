@extends('admin.layouts.main')

@section('content')
<div class="container-fluid pt-4 px-4">

    <!-- Page Header -->
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center gap-3">
            <div>
                <h4 class="fw-bold mb-0" style="color: #3d2c1e;">
                    <i class="bi bi-question-circle-fill me-2" style="color: #d4a373;"></i>
                    Pusat Bantuan & FAQ
                </h4>
                <p class="text-muted small mb-0">Kelola pertanyaan yang sering diajukan</p>
            </div>
            <button class="btn rounded-pill px-4" 
                    style="background: linear-gradient(135deg, #d4a373, #e9c46a); color: #3d2c1e; font-weight: 600; box-shadow: 0 4px 15px rgba(212, 163, 115, 0.3);"
                    data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg me-2"></i> Tambah FAQ
            </button>
        </div>

        <!-- Search Bar -->
        <form action="{{ route('pusat-bantuan.index') }}" method="GET" class="position-relative" style="width: 280px;">
            <input type="text" name="search" class="form-control rounded-pill ps-4 pe-5 py-2 shadow-sm" 
                   placeholder="Cari bantuan..." value="{{ request('search') }}" 
                   style="background: white; border: 1px solid rgba(212, 163, 115, 0.15); color: #3d2c1e; font-size: 0.9rem;">
            <button type="submit" class="btn position-absolute end-0 top-50 translate-middle-y me-2 border-0 bg-transparent" style="color: #d4a373;">
                <i class="bi bi-search fs-5"></i>
            </button>
        </form>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert alert-success border-0 rounded-4 shadow-sm d-flex align-items-center" role="alert" style="background: rgba(82, 183, 136, 0.1); color: #2d6a4f; border-left: 4px solid #52b788;">
            <i class="bi bi-check-circle-fill me-3" style="font-size: 1.2rem;"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Alert Error -->
    @if(session('error'))
        <div class="alert alert-danger border-0 rounded-4 shadow-sm d-flex align-items-center" role="alert" style="background: rgba(220, 38, 38, 0.08); color: #dc2626; border-left: 4px solid #dc2626;">
            <i class="bi bi-exclamation-triangle-fill me-3" style="font-size: 1.2rem;"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- FAQ List -->
    <div class="faq-container">
        @forelse($faqs as $faq)
        <div class="card border-0 shadow-sm rounded-4 mb-4 p-4" style="background: white; transition: all 0.3s ease; position: relative;">
            <div class="d-flex align-items-start gap-3">
                <!-- Icon -->
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" 
                     style="width: 48px; height: 48px; background: rgba(212, 163, 115, 0.1); margin-top: 4px;">
                    <i class="bi bi-question-lg" style="color: #d4a373; font-size: 1.2rem;"></i>
                </div>
                
                <!-- Content -->
                <div class="flex-grow-1">
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                        <h5 class="fw-bold mb-0" style="color: #3d2c1e;">{{ $faq->pertanyaan }}</h5>
                        <span class="badge rounded-pill px-3 py-2" style="background: rgba(212, 163, 115, 0.08); color: #8a7a6a; font-weight: 500; font-size: 0.7rem;">
                            {{ $faq->kategori ?? 'Umum' }}
                        </span>
                    </div>
                    <p class="text-muted mb-0" style="line-height: 1.7; max-width: 80%;">
                        {{ $faq->jawaban }}
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-1 flex-shrink-0">
                    <button class="btn btn-sm rounded-pill px-3" 
                            style="background: rgba(212, 163, 115, 0.08); color: #d4a373; transition: all 0.3s ease;"
                            onmouseover="this.style.background='rgba(212, 163, 115, 0.15)'"
                            onmouseout="this.style.background='rgba(212, 163, 115, 0.08)'"
                            data-bs-toggle="modal" data-bs-target="#modalEdit{{ $faq->id }}">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </button>
                    <form action="{{ route('pusat-bantuan.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus FAQ ini?')">
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
        @empty
        <div class="card border-0 shadow-sm rounded-4 p-5 text-center" style="background: white;">
            <div class="d-flex flex-column align-items-center">
                <div class="rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: rgba(212, 163, 115, 0.08);">
                    <i class="bi bi-chat-left-dots" style="font-size: 2.5rem; color: #b8a89a;"></i>
                </div>
                <h6 class="fw-bold" style="color: #3d2c1e;">Belum ada FAQ</h6>
                <p class="text-muted small">Silakan tambahkan FAQ baru dengan klik tombol di atas</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($faqs instanceof \Illuminate\Pagination\LengthAwarePaginator && $faqs->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-4">
        <p class="text-muted small mb-0">
            Menampilkan {{ $faqs->firstItem() }} - {{ $faqs->lastItem() }} dari {{ $faqs->total() }} data
        </p>
        <nav>
            <ul class="pagination pagination-sm mb-0">
                {{ $faqs->links('pagination::bootstrap-5') }}
            </ul>
        </nav>
    </div>
    @endif

</div>

<!-- Include Modals -->
@include('admin.pages.pusat_bantuan.create')

<!-- Include Edit Modals - dipisahkan per item untuk menghindari duplikasi -->
@foreach($faqs as $faq)
    @include('admin.pages.pusat_bantuan.edit', ['faq' => $faq])
@endforeach

<style>
    /* Hover effect for FAQ cards */
    .faq-container .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 40px rgba(61, 44, 30, 0.08) !important;
        border-color: rgba(212, 163, 115, 0.1) !important;
    }

    /* Pagination Styling */
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

    /* Modal transition fix */
    .modal.fade .modal-dialog {
        transition: transform 0.3s ease-out;
    }

    .modal.fade .modal-dialog {
        transform: scale(0.9);
    }

    .modal.show .modal-dialog {
        transform: scale(1);
    }
</style>

<!-- Script untuk memastikan modal berfungsi -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi semua modal
    var modals = document.querySelectorAll('.modal');
    modals.forEach(function(modal) {
        new bootstrap.Modal(modal, {
            backdrop: true,
            keyboard: true
        });
    });

    // Reset form saat modal ditutup
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('hidden.bs.modal', function() {
            const form = this.querySelector('form');
            if (form) {
                form.querySelectorAll('.is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });
            }
        });
    });

    // Debug: cek apakah modal terdeteksi
    console.log('Modal terdeteksi:', document.querySelectorAll('.modal').length);
});
</script>

@endsection