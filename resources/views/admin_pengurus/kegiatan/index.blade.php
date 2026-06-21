@extends('admin_pengurus.layouts.main')

@section('content')

<div class="card shadow-sm">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="card-title m-0">
            Data Kegiatan
        </h3>

        <a href="{{ route('admin-pengurus.kegiatan.create') }}"
           class="btn btn-primary btn-sm">
            + Tambah
        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead class="table-light">
                <tr>
                    <th width="60">No</th>
                    <th>Nama Kegiatan</th>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th width="220">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($kegiatan as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->judul }}</td>

                    <td>{{ $item->tanggal_kegiatan }}</td>

                    <td>{{ $item->lokasi }}</td>

                    <td>

                        <a href="{{ route('admin-pengurus.kegiatan.show', $item->id) }}"
                           class="btn btn-info btn-sm">
                            Detail
                        </a>

                        <a href="{{ route('admin-pengurus.kegiatan.edit', $item->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('admin-pengurus.kegiatan.delete', $item->id) }}"
                              method="POST"
                              style="display:inline-block;">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus kegiatan?')">
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="5" class="text-center">
                        Belum ada kegiatan
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection