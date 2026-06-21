@extends('admin.layouts.main')
@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Detail Profil Pendaftar</h3>
                
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                @if($pendaftaran->foto)
                                    <img src="{{ Storage::url($pendaftaran->foto) }}" alt="{{ $pendaftaran->nama_lengkap }}" class="img-fluid rounded-circle" style="width: 200px; height: 200px; object-fit: cover; border: 3px solid #ddd;">
                                @else
                                    <div class="bg-secondary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 200px; height: 200px;">
                                        <i class="fas fa-user fa-5x text-white"></i>
                                    </div>
                                @endif
                                <div class="mt-3">
                                    <span class="badge {{ $pendaftaran->status == 'pending' ? 'bg-warning' : ($pendaftaran->status == 'diterima' ? 'bg-success' : 'bg-danger') }} text-white p-2">
                                        Status: {{ ucfirst($pendaftaran->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Informasi Pribadi</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th width="200">Nama Lengkap</th>
                                                <td>{{ $pendaftaran->nama_lengkap }}</td>
                                            </tr>
                                            <tr>
                                                <th>NPM</th>
                                                <td><strong>{{ $pendaftaran->npm }}</strong></td>
                                            </tr>
                                            <tr>
                                                <th>Program Studi</th>
                                                <td>{{ $pendaftaran->prodi }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $pendaftaran->email ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>No. Telepon/WA</th>
                                                <td>{{ $pendaftaran->no_telepon ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tahun Angkatan</th>
                                                <td>{{ $pendaftaran->angkatan ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Alamat</th>
                                                <td>{{ $pendaftaran->alamat ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Mendaftar</th>
                                                <td>{{ $pendaftaran->created_at ? $pendaftaran->created_at->format('d/m/Y H:i:s') : '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Terakhir Diupdate</th>
                                                <td>{{ $pendaftaran->updated_at ? $pendaftaran->updated_at->format('d/m/Y H:i:s') : '-' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($pendaftaran->catatan_admin)
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Catatan Admin</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-0">{{ $pendaftaran->catatan_admin }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="text-center mt-4">
                            <form action="{{ route('pendaftaran.destroy', $pendaftaran->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pendaftar ini? Data yang dihapus tidak dapat dikembalikan!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i> Hapus Data Pendaftar
                                </button>
                            </form>
                            <a href="{{ route('pendaftaran.admin') }}" class="btn btn-secondary btn-sm">
    <i class="fas fa-arrow-left"></i> Kembali
</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection