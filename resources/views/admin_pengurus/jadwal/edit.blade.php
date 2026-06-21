@extends('admin_pengurus.layouts.main')

@section('title', 'Edit Jadwal')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            Edit Jadwal
        </div>

        <div class="card-body">

            <form action="{{ route('admin-pengurus.jadwal.update',$jadwal->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Uraian</label>

                    <input type="text"
                           name="uraian"
                           class="form-control"
                           value="{{ $jadwal->uraian }}"
                           required>
                </div>

                <div class="mb-3">
                    <label>Sesi 1 Buka</label>

                    <input type="date"
                           name="sesi_1_buka"
                           class="form-control"
                           value="{{ $jadwal->sesi_1_buka }}">
                </div>

                <div class="mb-3">
                    <label>Sesi 1 Tutup</label>

                    <input type="date"
                           name="sesi_1_tutup"
                           class="form-control"
                           value="{{ $jadwal->sesi_1_tutup }}">
                </div>

                <div class="mb-3">
                    <label>Sesi 2 Buka</label>

                    <input type="date"
                           name="sesi_2_buka"
                           class="form-control"
                           value="{{ $jadwal->sesi_2_buka }}">
                </div>

                <div class="mb-3">
                    <label>Sesi 2 Tutup</label>

                    <input type="date"
                           name="sesi_2_tutup"
                           class="form-control"
                           value="{{ $jadwal->sesi_2_tutup }}">
                </div>

                <button class="btn btn-primary">
                    Update
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