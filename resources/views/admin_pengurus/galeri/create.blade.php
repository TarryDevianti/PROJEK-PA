@extends('admin_pengurus.layouts.main')

@section('title', 'Tambah Galeri')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            Tambah Galeri
        </div>

        <div class="card-body">

            <form action="{{ route('admin-pengurus.galeri.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text"
                           name="judul"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="4"
                              required></textarea>
                </div>

                <div class="mb-3">
                    <label>Foto</label>
                    <input type="file"
                           name="gambar"
                           class="form-control"
                           required>
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

            </form>

        </div>

    </div>

</div>

@endsection