@extends('admin.layouts.main')

@section('content')

<div class="app-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">

                    <div class="card-header d-flex justify-content-between align-items-center">

                        <h3 class="card-title mb-0">
                            <i class="fas fa-info-circle"></i>
                            Detail Kegiatan
                        </h3>

                        <a href="{{ route('kegiatan.ukm', ['slug' => $ukm->slug]) }}"
                           class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-8">

                                <h2 class="fw-bold">
                                    {{ $kegiatan->judul }}
                                </h2>

                                <div class="text-muted mb-3">

                                    <i class="fas fa-calendar-alt"></i>
                                    Dipublikasikan:
                                    {{ $kegiatan->formatted_date }}

                                    <span class="mx-2">|</span>

                                    <i class="fas fa-eye"></i>
                                    Dilihat:
                                    {{ $kegiatan->views }}
                                    kali

                                    @if($kegiatan->tanggal_kegiatan)
                                        <br>

                                        <i class="fas fa-calendar-check"></i>
                                        Tanggal Kegiatan:
                                        {{ $kegiatan->formatted_tanggal_kegiatan }}
                                    @endif

                                    @if($kegiatan->lokasi)
                                        <br>

                                        <i class="fas fa-map-marker-alt"></i>
                                        Lokasi:
                                        {{ $kegiatan->lokasi }}
                                    @endif

                                    <br>

                                    <span class="badge {{ $kegiatan->status == 'published' ? 'bg-success' : 'bg-warning' }} mt-2">
                                        Status:
                                        {{ ucfirst($kegiatan->status) }}
                                    </span>

                                </div>

                                <hr>

                                <h5>Deskripsi Kegiatan</h5>

                                <div class="mt-3">
                                    {!! nl2br(e($kegiatan->deskripsi)) !!}
                                </div>

                            </div>

                            <div class="col-md-4">

                                @if($kegiatan->foto)

                                    <img src="{{ Storage::url($kegiatan->foto) }}"
                                         alt="{{ $kegiatan->judul }}"
                                         class="img-fluid rounded shadow">

                                @else

                                    <div class="bg-secondary text-white rounded d-flex justify-content-center align-items-center"
                                         style="height:300px;">

                                        <i class="fas fa-image fa-5x"></i>

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection