@extends('admin.layouts.main')
@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Tambah Pengurus Baru</h3>
                    <div class="card-tools">
                        <a href="{{ route('pengurus.admin') }}" class="btn btn-secondary btn-sm">
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('pengurus.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                           <select name="pendaftaran_id" class="form-control" required>
                                <option value="">-- Pilih Nama Pendaftar --</option>
                                @foreach($pendaftar as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nama_lengkap }} - (UKM: {{ strtoupper($item->ukm_tujuan) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('pendaftaran_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                       <div class="form-group">
                            <label>Jabatan</label>

                            <select name="jabatan" class="form-control" required>
                                <option value="">-- Pilih Jabatan --</option>
                                <option value="Ketua">Ketua</option>
                                <option value="Sekretaris">Sekretaris</option>
                                <option value="Bendahara">Bendahara</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="foto" class="form-control-file @error('foto') is-invalid @enderror" accept="image/*">
                            <small class="form-text text-muted">Format: JPG, JPEG, PNG. Max: 2MB</small>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Periode</label>
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Urutan</label>
                            <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror" value="{{ old('urutan', 0) }}">
                            <small class="form-text text-muted">Semakin kecil angka, posisi semakin atas</small>
                            @error('urutan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Aktif</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('pengurus.admin') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection