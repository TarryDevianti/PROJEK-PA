@extends('admin.layouts.main')
@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Edit Data Pengurus</h3>
                    <div class="card-tools">
                        <a href="{{ route('pengurus.admin') }}" class="btn btn-secondary btn-sm">
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('pengurus.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        @if($pengurus->foto)
                        <div class="form-group">
                            <label>Foto Saat Ini</label><br>
                            <img src="{{ Storage::url($pengurus->foto) }}" alt="{{ $pengurus->nama }}" width="100" height="100" style="object-fit: cover; border-radius: 10px;">
                        </div>
                        @endif

                        <div class="form-group">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $pengurus->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jabatan <span class="text-danger">*</span></label>
                            <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan', $pengurus->jabatan) }}" required>
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Periode <span class="text-danger">*</span></label>
                            <input type="text" name="periode" class="form-control @error('periode') is-invalid @enderror" value="{{ old('periode', $pengurus->periode) }}" required>
                            @error('periode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Ganti Foto</label>
                            <input type="file" name="foto" class="form-control-file @error('foto') is-invalid @enderror" accept="image/*">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti foto</small>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4">{{ old('deskripsi', $pengurus->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Urutan</label>
                            <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror" value="{{ old('urutan', $pengurus->urutan) }}">
                            <small class="form-text text-muted">Semakin kecil angka, posisi semakin atas</small>
                            @error('urutan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', $pengurus->is_active) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Aktif</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('pengurus.admin') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection