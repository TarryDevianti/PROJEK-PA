@extends('admin.layouts.main')
@section('content')

<div class="app-content">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold mb-0" style="color: #3d2c1e;">
                    <i class="fas fa-user-tie me-2" style="color: #d4a373;"></i>
                    Data Pengurus UKM
                </h4>
                <p class="text-muted small mb-0">Kelola data pengurus UKM di FMIPA</p>
            </div>
            <a href="{{ route('pengurus.create') }}" class="btn rounded-pill px-4" style="background: linear-gradient(135deg, #d4a373, #e9c46a); color: #3d2c1e; font-weight: 600; box-shadow: 0 4px 15px rgba(212, 163, 115, 0.3);">
                <i class="fas fa-plus me-2"></i> Tambah Pengurus
            </a>
        </div>

        <!-- Alert Success -->
        @if(session('success'))
            <div class="alert alert-success border-0 rounded-4 shadow-sm d-flex align-items-center" role="alert" style="background: rgba(82, 183, 136, 0.1); color: #2d6a4f; border-left: 4px solid #52b788;">
                <i class="fas fa-check-circle me-3" style="font-size: 1.2rem;"></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Table Card -->
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div>
                        <h5 class="fw-bold mb-0" style="color: #3d2c1e;">
                            <i class="fas fa-list me-2" style="color: #d4a373;"></i>
                            Daftar Pengurus
                        </h5>
                        <p class="text-muted small mb-0">Menampilkan semua data pengurus UKM</p>
                    </div>
                    <div class="d-flex gap-2">
                        <div class="input-group" style="width: 250px;">
                            <span class="input-group-text border-0 bg-light" style="border-radius: 50px 0 0 50px;">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-0 bg-light" placeholder="Cari pengurus..." style="border-radius: 0 50px 50px 0;" id="searchInput">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="pengurusTable">
                        <thead>
                            <tr style="background: rgba(212, 163, 115, 0.06);">
                                <th style="width: 50px; border-radius: 12px 0 0 0;" class="fw-semibold text-muted py-3">NO</th>
                                <th class="fw-semibold text-muted py-3">Foto</th>
                                <th class="fw-semibold text-muted py-3">Nama</th>
                                <th class="fw-semibold text-muted py-3">Jabatan</th>
                                <th class="fw-semibold text-muted py-3">Periode</th>
                                <th class="fw-semibold text-muted py-3">Status</th>
                                <th style="border-radius: 0 12px 0 0;" class="fw-semibold text-muted py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengurus as $key => $item)
                            <tr class="border-bottom" style="transition: all 0.3s ease;">
                                <td class="fw-semibold text-muted">{{ $pengurus->firstItem() + $key }}</td>
                                <td>
                                    @if($item->foto)
                                        <img src="{{ Storage::url($item->foto) }}" 
                                             alt="{{ $item->nama }}" 
                                             width="50" 
                                             height="50" 
                                             style="object-fit: cover; border-radius: 50%; border: 3px solid rgba(212, 163, 115, 0.2);">
                                    @else
                                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background: rgba(212, 163, 115, 0.1); border: 3px solid rgba(212, 163, 115, 0.2);">
                                            <i class="fas fa-user text-muted" style="font-size: 1.2rem;"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold" style="color: #3d2c1e;">{{ $item->nama }}</td>
                                <td>
                                    <span class="badge rounded-pill px-3 py-2" style="background: rgba(212, 163, 115, 0.12); color: #d4a373; font-weight: 500;">
                                        {{ $item->jabatan }}
                                    </span>
                                </td>
                                <td style="color: #8a7a6a;">{{ $item->periode }}</td>
                                <td>
                                    @if($item->is_active)
                                        <span class="badge rounded-pill px-3 py-2" style="background: rgba(82, 183, 136, 0.12); color: #2d6a4f; font-weight: 500;">
                                            <i class="fas fa-circle me-1" style="font-size: 0.5rem; color: #52b788;"></i> Aktif
                                        </span>
                                    @else
                                        <span class="badge rounded-pill px-3 py-2" style="background: rgba(220, 38, 38, 0.1); color: #dc2626; font-weight: 500;">
                                            <i class="fas fa-circle me-1" style="font-size: 0.5rem; color: #dc2626;"></i> Tidak Aktif
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-1 justify-content-center">
                                        <a href="{{ route('pengurus.edit', $item->id) }}" 
                                           class="btn btn-sm rounded-pill px-3" 
                                           style="background: rgba(212, 163, 115, 0.1); color: #d4a373; transition: all 0.3s ease;"
                                           onmouseover="this.style.background='rgba(212, 163, 115, 0.2)'"
                                           onmouseout="this.style.background='rgba(212, 163, 115, 0.1)'">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('pengurus.destroy', $item->id) }}" 
                                              method="POST" 
                                              style="display: inline-block;" 
                                              onsubmit="return confirm('Yakin ingin menghapus data pengurus ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm rounded-pill px-3" 
                                                    style="background: rgba(220, 38, 38, 0.08); color: #dc2626; transition: all 0.3s ease; border: none;"
                                                    onmouseover="this.style.background='rgba(220, 38, 38, 0.15)'"
                                                    onmouseout="this.style.background='rgba(220, 38, 38, 0.08)'">
                                                <i class="fas fa-trash me-1"></i> Hapus
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
                                            <i class="fas fa-user-slash" style="font-size: 2.5rem; color: #b8a89a;"></i>
                                        </div>
                                        <h6 class="fw-bold" style="color: #3d2c1e;">Belum ada data pengurus</h6>
                                        <p class="text-muted small">Silakan tambahkan pengurus baru dengan klik tombol di atas</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($pengurus instanceof \Illuminate\Pagination\LengthAwarePaginator && $pengurus->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <p class="text-muted small mb-0">
                        Menampilkan {{ $pengurus->firstItem() }} - {{ $pengurus->lastItem() }} dari {{ $pengurus->total() }} data
                    </p>
                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            {{ $pengurus->links('pagination::bootstrap-5') }}
                        </ul>
                    </nav>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>

<!-- Script untuk Search -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('pengurusTable');
    const rows = table.querySelectorAll('tbody tr:not(.empty-row)');

    searchInput.addEventListener('keyup', function() {
        const searchText = this.value.toLowerCase();
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchText) ? '' : 'none';
        });
    });
});
</script>

@endsection