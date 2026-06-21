@extends(
    auth()->user()->role == 'super_admin'
        ? 'admin.layouts.main'
        : 'admin.layouts.main_pengurus'
)

@section('content')

<div class="container py-5">

    <h2 class="text-center mb-5">
        KEGIATAN {{ $ukm->nama_ukm }}
    </h2>

    <div class="row">

        @forelse($kegiatan as $item)

        <div class="col-md-4 mb-4">

            <div class="card shadow border-0 h-100">

                                @if($item->foto)
                    <img src="{{ Storage::url($item->foto) }}"
                        class="card-img-top"
                        style="height:250px; object-fit:cover;"
                        alt="{{ $item->judul }}">
                @else
                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                        style="height:250px;">
                        Tidak ada gambar
                    </div>
                @endif

                <div class="card-body">

                    <h5>{{ $item->nama_kegiatan }}</h5>

                    <p>
                        {{ Str::limit($item->deskripsi, 80) }}
                    </p>

                    <a href="{{ route('kegiatan.detail', [$ukm->slug, $item->id]) }}"
                       class="btn btn-dark">
                        Detail
                    </a>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12 text-center">
            <p>Belum ada kegiatan.</p>
        </div>

        @endforelse

    </div>

</div>

@endsection