@extends('admin_pengurus.layouts.main')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Edit Anggota</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('admin-pengurus.anggota.update', $anggota->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text"
                       class="form-control"
                       name="nama_lengkap"
                       value="{{ old('nama_lengkap', $anggota->nama_lengkap) }}">
            </div>

            <div class="mb-3">
                <label>NPM</label>
                <input type="text"
                       class="form-control"
                       name="npm"
                       value="{{ old('npm', $anggota->npm) }}">
            </div>

            <div class="mb-3">
                <label>Program Studi</label>
                <input type="text"
                       class="form-control"
                       name="prodi"
                       value="{{ old('prodi', $anggota->prodi) }}">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email"
                       class="form-control"
                       name="email"
                       value="{{ old('email', $anggota->email) }}">
            </div>

            <div class="mb-3">
                <label>No Telepon</label>
                <input type="text"
                       class="form-control"
                       name="no_telepon"
                       value="{{ old('no_telepon', $anggota->no_telepon) }}">
            </div>

            <div class="mb-3">
                <label>Angkatan</label>
                <input type="text"
                       class="form-control"
                       name="angkatan"
                       value="{{ old('angkatan', $anggota->angkatan) }}">
            </div>

            <div class="mb-3">
                <label>Divisi</label>
                <input type="text"
                       class="form-control"
                       name="divisi_tujuan"
                       value="{{ old('divisi_tujuan', $anggota->divisi_tujuan) }}">
            </div>

            <hr>

            <div class="mb-3">
                <label>No Anggota</label>
                <input type="text"
                       name="no_anggota"
                       class="form-control"
                       value="{{ old('no_anggota', $anggota->no_anggota) }}">
            </div>

            <div class="mb-3">
                <label>Jabatan</label>
                <input type="text"
                       name="jabatan"
                       class="form-control"
                       value="{{ old('jabatan', $anggota->jabatan) }}">
            </div>

            <button type="submit" class="btn btn-success">
                Update
            </button>

            <a href="{{ route('admin-pengurus.anggota') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection