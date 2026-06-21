@extends('admin.layouts.main')
@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-plus-circle"></i> Tambah Kegiatan Baru
                        </h3>
                        <div class="card-tools">
                            <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group">
                                <label>Pilih UKM <span class="text-danger">*</span></label>
                                <select name="ukm_id" class="form-control @error('ukm_id') is-invalid @enderror" required>
                                    <option value="">Pilih UKM</option>
                                    @foreach($ukms as $ukm)
                                        <option value="{{ $ukm->id }}" {{ old('ukm_id') == $ukm->id ? 'selected' : '' }}>
                                            {{ $ukm->nama_ukm }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ukm_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Judul Kegiatan <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="judul" 
                                       class="form-control @error('judul') is-invalid @enderror" 
                                       value="{{ old('judul') }}" 
                                       required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Deskripsi Kegiatan <span class="text-danger">*</span></label>
                                <textarea name="deskripsi" 
                                          class="form-control @error('deskripsi') is-invalid @enderror" 
                                          rows="6" 
                                          required>{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Foto Kegiatan</label>
                                        <input type="file" 
                                               name="foto" 
                                               class="form-control-file @error('foto') is-invalid @enderror" 
                                               accept="image/*">
                                        <small class="form-text text-muted">
                                            Format: JPG, JPEG, PNG. Max: 5MB
                                        </small>
                                        @error('foto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Kegiatan</label>
                                        <input type="date" 
                                               name="tanggal_kegiatan" 
                                               class="form-control @error('tanggal_kegiatan') is-invalid @enderror" 
                                               value="{{ old('tanggal_kegiatan') }}">
                                        @error('tanggal_kegiatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Lokasi Kegiatan</label>
                                        <input type="text" 
                                               name="lokasi" 
                                               class="form-control @error('lokasi') is-invalid @enderror" 
                                               value="{{ old('lokasi') }}"
                                               placeholder="Contoh: Aula Kampus">
                                        @error('lokasi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                                            <option value="published" {{ old('status', 'published') == 'published' ? 'selected' : '' }}>
                                                Publish (Tampilkan)
                                            </option>
                                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>
                                                Draft (Sembunyikan)
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection