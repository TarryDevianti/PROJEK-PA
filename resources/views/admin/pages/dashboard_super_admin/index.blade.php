@extends('admin.layouts.main')

@section('content')

<div class="container-fluid">

    <div class="row">

        <div class="col-md-6 mb-4">
            <div class="small-box bg-primary shadow">
                <div class="inner">
                    <h3>{{ $totalUkm }}</h3>
                    <p>Total UKM</p>
                </div>
                <div class="icon">
                    <i class="fas fa-building"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="small-box bg-success shadow">
                <div class="inner">
                    <h3>{{ $seuramoe }}</h3>
                    <p>Total Anggota Seuramoe</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="small-box bg-warning shadow">
                <div class="inner">
                    <h3>{{ $barracuda }}</h3>
                    <p>Total Anggota Barracuda</p>
                </div>
                <div class="icon">
                    <i class="fas fa-fish"></i>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="small-box bg-danger shadow">
                <div class="inner">
                    <h3>{{ $ululAlbab }}</h3>
                    <p>Total Anggota LDF Ulul Albab</p>
                </div>
                <div class="icon">
                    <i class="fas fa-mosque"></i>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow">

        <div class="card-header">
            <h3 class="card-title">
                Grafik Anggota UKM
            </h3>
        </div>

        <div class="card-body">

            <canvas id="ukmChart" height="100"></canvas>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('ukmChart');

new Chart(ctx, {

    type: 'bar',

    data: {
        labels: [
            'Seuramoe',
            'Barracuda',
            'LDF Ulul Albab'
        ],

        datasets: [{
            label: 'Jumlah Anggota',
            data: [
                {{ $seuramoe }},
                {{ $barracuda }},
                {{ $ululAlbab }}
            ]
        }]
    }

});

</script>

@endsection