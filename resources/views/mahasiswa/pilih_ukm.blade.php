@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12">
        <h2 class="text-center mb-4 fw-bold" style="color: #3d2c1e;">Pilih UKM</h2>
        <div class="row">
            @foreach($ukms as $ukm)
            <div class="col-md-4 mb-4">
                <div class="card card-shadow h-100">
                    <div class="card-body text-center">
                        @if($ukm->logo)
                            <img src="{{ asset('storage/' . $ukm->logo) }}"
                                 width="120" class="mb-3" alt="{{ $ukm->nama_ukm }}">
                        @endif
                        <h5 class="fw-bold">{{ $ukm->nama_ukm }}</h5>
                        <p class="text-muted">{{ Str::limit($ukm->deskripsi, 100) }}</p>
                        
                        <a href="{{ url('/pendaftaran/isi/' . $ukm->slug) }}" class="btn btn-warning rounded-pill px-4" 
                           style="background: linear-gradient(135deg, #d4a373, #e9c46a); color: #3d2c1e; font-weight: 600; border: none;">
                            Daftar UKM
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection