@extends('admin_pengurus.layouts.main')

@section('title', 'Galeri')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="card-title m-0">
                Data Galeri
            </h3>

            <a href="{{ route('admin-pengurus.galeri.create') }}"
               class="btn btn-primary btn-sm">
                + Tambah
            </a>

        </div>

        <div class="card-body">

            <div class="row">

                @forelse($galeri as $item)

                <div class="col-md-3 mb-4">

                    <div class="card">

                        <img src="{{ asset('storage/' . $item->gambar) }}"
                            class="card-img-top"
                            style="height:200px; object-fit:cover;">

<div class="card-body">
    <h5>{{ $item->judul }}</h5>
    
    <p class="text-muted" style="font-size: 0.9rem;">{{ $item->deskripsi }}</p>

    <a href="{{ route('admin-pengurus.galeri.edit', $item->id) }}"
       class="btn btn-warning btn-sm">
        Edit
    </a>

    <form action="{{ route('admin-pengurus.galeri.destroy', $item->id) }}"
          method="POST"
          style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn-sm">
            Hapus
        </button>
    </form>
</div>
                    </div>

                </div>

                @empty

                <div class="col-12 text-center">
                    Belum ada galeri
                </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection