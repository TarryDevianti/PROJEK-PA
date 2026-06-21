@extends('admin.layouts.main_pengurus')

@section('content')

<div class="container">

```
<h3 class="mb-4">Tambah Kegiatan</h3>

<form action="{{ route('admin-pengurus.kegiatan.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div class="mb-3">
        <label>Judul Kegiatan</label>

        <input type="text"
               name="judul"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>

        <textarea name="deskripsi"
                  class="form-control"
                  rows="5"
                  required></textarea>
    </div>

    <div class="mb-3">
        <label>Tanggal Kegiatan</label>

        <input type="date"
               name="tanggal_kegiatan"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label>Lokasi</label>

        <input type="text"
               name="lokasi"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label>Foto Kegiatan</label>

        <input type="file"
               name="foto"
               class="form-control">
    </div>

    <button class="btn btn-primary">
        Simpan
    </button>

</form>
```

</div>

@endsection
