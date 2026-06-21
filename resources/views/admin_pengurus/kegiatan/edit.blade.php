@extends('admin_pengurus.layouts.main')

@section('content')

<div class="container-fluid">

    <div class="card">
        
        <div class="card-header">
            <h3>Edit Kegiatan</h3>
        </div>

        <div class="card-body">

            <form action="{{ route('admin-pengurus.kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Judul Kegiatan</label>
                    <input type="text"
                           name="judul"
                           class="form-control"
                           value="{{ $kegiatan->judul }}">
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="5">{{ $kegiatan->deskripsi }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date"
                           name="tanggal_kegiatan"
                           class="form-control"
                           value="{{ $kegiatan->tanggal_kegiatan }}">
                </div>

                <div class="mb-3">
                    <label>Lokasi</label>
                    <input type="text"
                           name="lokasi"
                           class="form-control"
                           value="{{ $kegiatan->lokasi }}">
                </div>

                <div class="mb-3">
                    <label>Foto</label>
                    <input type="file"
                           name="foto"
                           class="form-control">
                </div>

                @if($kegiatan->foto)
                    <img src="{{ asset('storage/' . $kegiatan->foto) }}"
                         width="200"
                         class="mb-3">
                @endif

                <button type="submit" class="btn btn-primary">
                    Update
                </button>

                <a href="{{ route('admin-pengurus.kegiatan') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>
</div>

@endsection