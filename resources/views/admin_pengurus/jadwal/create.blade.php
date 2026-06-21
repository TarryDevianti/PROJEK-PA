@extends('admin_pengurus.layouts.main')

@section('title', 'Tambah Jadwal')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            Tambah Jadwal
        </div>

        <div class="card-body">

            <form action="{{ route('admin-pengurus.jadwal.store') }}"
                  method="POST">

                @csrf

                <div class="mb-3">
                    <label>Uraian</label>

                    <input type="text"
                           name="uraian"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Sesi 1 Buka</label>

                    <input type="date"
                           name="sesi_1_buka"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Sesi 1 Tutup</label>

                    <input type="date"
                           name="sesi_1_tutup"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Sesi 2 Buka</label>

                    <input type="date"
                           name="sesi_2_buka"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Sesi 2 Tutup</label>

                    <input type="date"
                           name="sesi_2_tutup"
                           class="form-control">
                </div>

                <button class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('admin-pengurus.jadwal') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

@endsection