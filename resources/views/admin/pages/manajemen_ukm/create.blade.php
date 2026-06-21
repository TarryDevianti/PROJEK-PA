@extends('admin.layouts.main')

@section('content')
<div class="container-fluid pt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0" style="border-radius: 15px;">
                <div class="card-header bg-dark text-white py-3" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-plus-circle me-2"></i>Tambah Data UKM Baru</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('manajemen-ukm.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama UKM</label>
                            <input type="text" name="nama_ukm" class="form-control @error('nama_ukm') is-invalid @enderror" 
                                   placeholder="Contoh: UKM Seni" value="{{ old('nama_ukm') }}" required>
                            @error('nama_ukm') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Status Awal</label>
                            <select name="status" class="form-select">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Logo UKM</label>
                            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
                            <small class="text-muted">Format: jpg, jpeg, png. Maks: 2MB</small>
                            @error('logo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-dark px-4">
                                <i class="bi bi-save me-1"></i> Simpan UKM
                            </button>
                            <a href="{{ route('manajemen-ukm.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection