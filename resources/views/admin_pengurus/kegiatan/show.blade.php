@extends('admin_pengurus.layouts.main')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Detail Kegiatan</h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="200">Nama Kegiatan</th>
                <td>{{ $kegiatan->nama_kegiatan }}</td>
            </tr>

            <tr>
                <th>Deskripsi</th>
                <td>{{ $kegiatan->deskripsi }}</td>
            </tr>

            <tr>
                <th>Tanggal</th>
                <td>{{ $kegiatan->tanggal }}</td>
            </tr>

            <tr>
                <th>Lokasi</th>
                <td>{{ $kegiatan->lokasi }}</td>
            </tr>

            <tr>
                <th>Foto</th>
                <td>

                    @if($kegiatan->foto)

                        <img src="{{ asset('storage/' . $kegiatan->foto) }}"
                             width="250"
                             class="rounded">

                    @else

                        Tidak ada foto

                    @endif

                </td>
            </tr>

        </table>

        <a href="{{ route('admin-pengurus.kegiatan') }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </div>
</div>

@endsection