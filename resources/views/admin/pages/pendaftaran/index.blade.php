@extends('admin.layouts.main')
@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Data Pendaftar</h3>
                        <div class="card-tools">
                            <span class="badge bg-info text-white">
                                Total Pendaftar: {{ $pendaftaran->count() ?? 0 }}
                            </span>
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

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="width: 50px; text-align: center;">No</th>
                                        <th style="text-align: center;">Nama Lengkap</th>
                                        <th style="width: 150px; text-align: center;">NPM</th>
                                        <th style="text-align: center;">Program Studi</th>
                                        <th style="width: 150px; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                              <tbody>
                                @forelse($pendaftaran as $key => $item)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $item->nama_lengkap }}</td>
                                    <td class="text-center">{{ $item->npm }}</td>
                                    <td>{{ $item->prodi }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('pendaftaran.show', $item->id) }}" class="btn btn-info btn-sm">Lihat</a>

                                        {{-- TOMBOL HANYA MUNCUL UNTUK ADMIN UKM --}}
                                        @if(auth()->user()->role !== 'super_admin')
                                            <form action="{{ route('pendaftaran.terima', $item->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Terima</button>
                                            </form>
                                            
                                            <form action="{{ route('pendaftaran.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data pendaftar</td>
                                </tr>
                                @endforelse
                            </tbody>
                            </table>
                        </div>

                        @if(isset($pendaftaran) && method_exists($pendaftaran, 'links'))
                            <div class="mt-3">
                                {{ $pendaftaran->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection