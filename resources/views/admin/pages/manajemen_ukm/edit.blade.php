@extends('admin.layouts.main')

@section('content')
<div class="container-fluid pt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h5 class="mb-0 fw-bold">Edit Data UKM</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('manajemen-ukm.update', $ukm->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama UKM</label>
                            <input type="text" name="nama_ukm" class="form-control @error('nama_ukm') is-invalid @enderror" 
                                   value="{{ old('nama_ukm', $ukm->nama_ukm) }}" required>
                            @error('nama_ukm') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Status UKM</label>
                            <select name="status" class="form-select">
                                <option value="aktif" {{ $ukm->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ $ukm->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Logo UKM (Kosongkan jika tidak diganti)</label>
                            @if($ukm->logo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $ukm->logo) }}" width="80" class="img-thumbnail">
                                </div>
                            @endif
                            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
                            <small class="text-muted">Format: jpg, jpeg, png. Maks: 2MB</small>
                            @error('logo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                            <a href="{{ route('manajemen-ukm.index') }}" class="btn btn-secondary px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection