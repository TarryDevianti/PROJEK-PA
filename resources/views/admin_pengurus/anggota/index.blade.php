@extends('admin_pengurus.layouts.main')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Data Anggota</h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>No Anggota</th>
                    <th>Divisi</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($anggota as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->nama_lengkap }}</td>

                    <td>
                        {{ $item->no_anggota ?? '-' }}
                    </td>

                    <td>
                        {{ $item->divisi ?? $item->divisi_tujuan }}
                    </td>

                    <td>
                        {{ $item->jabatan ?? '-' }}
                    </td>

                    <td>
                        <span class="badge bg-success">
                            {{ $item->status }}
                        </span>
                    </td>

                    <td>

                        <a href="{{ route('admin-pengurus.anggota.show', $item->id) }}"
                           class="btn btn-info btn-sm">
                            Detail
                        </a>

                        <a href="{{ route('admin-pengurus.anggota.edit', $item->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('admin-pengurus.anggota.destroy', $item->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    onclick="return confirm('Yakin ingin menghapus anggota ini?')"
                                    class="btn btn-danger btn-sm">
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="7" class="text-center">
                        Belum ada anggota
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection