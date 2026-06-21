@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid pt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-uppercase bg-secondary text-white px-4 py-2 rounded">Manajemen UKM</h3>
            <a href="{{ route('manajemen-ukm.create') }}" class="btn btn-dark rounded-circle shadow">
                <i class="bi bi-plus-lg"></i>
            </a>
        </div>

        <!-- Tambahkan class 'g-3' (gutter) untuk memberi jarak antar kolom tanpa overflow -->
        <div class="row g-3"> 
            @foreach ($ukms as $index => $ukm)
                <!-- Bungkus card dengan 'col-12' agar mengambil lebar penuh secara aman -->
                <div class="col-12">
                    <div class="card bg-dark text-white border-0 shadow-sm mx-3" style="border-radius: 15px;">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <h3 class="me-4 text-secondary">{{ $index + 1 }}.</h3>
                                
                                {{-- Gunakan object-fit cover agar gambar tidak gepeng --}}
                                <img src="{{ $ukm->logo ? asset('storage/' . $ukm->logo) : asset('assets/img/default-logo.png') }}"
                                    class="rounded-circle bg-white p-1 me-4" 
                                    width="70" height="70" 
                                    style="object-fit: cover;">

                                <div>
                                    <h4 class="fw-bold mb-1">{{ $ukm->nama_ukm }}</h4>
                                    <p class="small text-secondary mb-0">
                                        <i class="bi bi-calendar-plus"></i> Ditambah:
                                        {{ $ukm->created_at->format('d M Y') }}<br>
                                        <i class="bi bi-arrow-repeat"></i> Update: {{ $ukm->updated_at->format('d M Y') }}
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button
                                    class="btn {{ $ukm->status == 'aktif' ? 'btn-success' : 'btn-secondary' }} btn-sm rounded-pill px-3 text-uppercase">
                                    {{ $ukm->status }}
                                </button>
                                <a href="{{ route('manajemen-ukm.edit', $ukm->id) }}"
                                    class="btn btn-primary btn-sm px-3">EDIT</a>
                                <form action="{{ route('manajemen-ukm.destroy', $ukm->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm px-3"
                                        onclick="return confirm('Yakin hapus UKM ini?')">HAPUS</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection