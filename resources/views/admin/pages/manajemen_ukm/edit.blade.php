@extends('admin.layouts.main')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header" style="background: linear-gradient(135deg, #3d2c1e, #5a4a3a); border: none; padding: 20px 30px; border-radius: 20px 20px 0 0;">
                    <h5 class="mb-0 fw-bold" style="color: #f5ede6;">
                        <i class="bi bi-pencil-square me-2"></i> Edit Data UKM
                    </h5>
                </div>
                <div class="card-body p-4" style="background: #fdf8f2;">
                    <form action="{{ route('manajemen-ukm.update', $ukm->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #3d2c1e;">
                                <i class="bi bi-building me-1" style="color: #d4a373;"></i> Nama UKM
                            </label>
                            <input type="text" name="nama_ukm" class="form-control rounded-3" 
                                   value="{{ old('nama_ukm', $ukm->nama_ukm) }}" required
                                   style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white;">
                            @error('nama_ukm') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #3d2c1e;">
                                <i class="bi bi-tag me-1" style="color: #d4a373;"></i> Status UKM
                            </label>
                            <select name="status" class="form-select rounded-3" 
                                    style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white; color: #3d2c1e;">
                                <option value="aktif" {{ $ukm->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ $ukm->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #3d2c1e;">
                                <i class="bi bi-image me-1" style="color: #d4a373;"></i> Logo UKM
                            </label>
                            @if($ukm->logo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $ukm->logo) }}" width="80" class="img-thumbnail rounded-3" style="border: 2px solid rgba(212, 163, 115, 0.15);">
                                </div>
                            @endif
                            <input type="file" name="logo" class="form-control rounded-3" 
                                   style="border: 1px solid rgba(212, 163, 115, 0.15); padding: 12px 16px; background: white;">
                            <small class="text-muted">Format: jpg, jpeg, png. Maks: 2MB</small>
                            @error('logo') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn rounded-pill px-4" 
                                    style="background: linear-gradient(135deg, #d4a373, #e9c46a); color: #3d2c1e; font-weight: 600; box-shadow: 0 4px 15px rgba(212, 163, 115, 0.3);">
                                <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('manajemen-ukm.index') }}" class="btn rounded-pill px-4" 
                               style="background: rgba(184, 168, 154, 0.15); color: #8a7a6a; font-weight: 500;">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection