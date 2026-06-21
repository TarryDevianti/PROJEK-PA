@extends('admin.layouts.main')
@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Data Pengurus</h3>
                    <div class="card-tools">
                        <a href="{{ route('pengurus.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Pengurus
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">NO</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Periode</th>
                                <th>Status</th>
                                <th style="width: 150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengurus as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    @if($item->foto)
                                        <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->nama }}" width="50" height="50" style="object-fit: cover; border-radius: 50%;">
                                    @else
                                        <span class="text-muted">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jabatan }}</td>
                                <td>{{ $item->periode }}</td>
                                <td>
                                    @if($item->is_active)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('pengurus.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('pengurus.destroy', $item->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data pengurus</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection