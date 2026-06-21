@extends('admin_pengurus.layouts.main')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Calon Anggota</h3>
    </div>

    <div class="card-body">

        <form action="#" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap">
            </div>

            <div class="mb-3">
                <label>NPM</label>
                <input type="text" class="form-control" name="npm">
            </div>

            <div class="mb-3">
                <label>Divisi</label>
                <input type="text" class="form-control" name="divisi_tujuan">
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea class="form-control" name="alamat"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan
            </button>

        </form>

    </div>
</div>

@endsection