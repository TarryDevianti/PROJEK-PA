@extends('admin_pengurus.layouts.main')

@section('content')

<div class="card">

    <div class="card-header">
        Edit Galeri
    </div>

    <div class="card-body">

        <form action="{{ route('admin-pengurus.galeri.update', $galeri->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Judul</label>
                <input type="text"
                       name="judul"
                       class="form-control"
                       value="{{ $galeri->judul }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi"
                          class="form-control"
                          rows="4"
                          required>{{ $galeri->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label>Foto Lama</label><br>

                <img src="{{ asset('storage/' . $galeri->gambar) }}"
                     width="250"
                     class="img-thumbnail">
            </div>

            <div class="mb-3">
                <label>Ganti Foto</label>

                <input type="file"
                       name="gambar"
                       class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('admin-pengurus.galeri') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection