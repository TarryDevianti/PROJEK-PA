@extends('admin_pengurus.layouts.main')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Calon Anggota</h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NPM</th>
                    <th>Divisi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($calonAnggota as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->nama_lengkap }}</td>

                    <td>{{ $item->npm }}</td>

                    <td>{{ $item->divisi_tujuan }}</td>

                    <td>
                        <span class="badge bg-warning">
                            {{ $item->status }}
                        </span>
                    </td>

                    <td>

                        <a href="{{ route('admin-pengurus.calon.show', $item->id) }}"
                           class="btn btn-info btn-sm">
                            Detail
                        </a>

                        <form action="{{ route('admin-pengurus.calon.terima', $item->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('PUT')

                            <button class="btn btn-success btn-sm">
                                Terima
                            </button>

                        </form>

                        <form action="{{ route('admin-pengurus.calon.tolak', $item->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('PUT')

                            <button class="btn btn-danger btn-sm">
                                Tolak
                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="text-center">
                        Belum ada calon anggota
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection