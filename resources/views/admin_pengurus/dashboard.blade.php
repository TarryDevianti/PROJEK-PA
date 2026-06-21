@extends('admin_pengurus.layouts.main')

@section('content')

<div class="row">

    <div class="col-lg-4 col-6">

        <div class="small-box text-bg-primary">

            <div class="inner">

                <h3>{{ $ukm->nama_ukm }}</h3>

                <p>UKM Admin</p>

            </div>

            <div class="icon">A
                <i class="bi bi-people-fill"></i>
            </div>

        </div>

    </div>

    <div class="col-lg-4 col-6">

        <div class="small-box text-bg-success">

            <div class="inner">

                <h3>{{ $jumlahAnggota }}</h3>

                <p>Total Anggota</p>

            </div>

            <div class="icon">
                <i class="bi bi-person-check-fill"></i>
            </div>

        </div>

    </div>

    <div class="col-lg-4 col-6">

        <div class="small-box text-bg-warning">

            <div class="inner">

                <h3>{{ $calonAnggota }}</h3>

                <p>Calon Anggota</p>

            </div>

            <div class="icon">
                <i class="bi bi-person-plus-fill"></i>
            </div>

        </div>

    </div>

</div>

@endsection