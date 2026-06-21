@extends('admin.layouts.main')

@section('content')

<div class="app-content">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-md-12">

                <div class="card shadow-sm">

                    <div class="card-header d-flex justify-content-between align-items-center">

                        <div>
                            <h4 class="mb-0">
                                <i class="fas fa-users me-2"></i>
                                Anggota {{ $ukm->nama_ukm ?? 'Semua UKM' }}
                            </h4>

                            <small class="text-muted">
                                Daftar anggota UKM
                            </small>
                        </div>

                        <span class="badge bg-primary fs-6">
                            {{ $anggotas->count() }} Anggota
                        </span>

                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-bordered table-hover align-middle">

                                <thead class="table-dark">

                                    <tr>
                                        <th width="60">No</th>
                                        <th>Nama Lengkap</th>
                                        <th>No Anggota</th>
                                        <th>Divisi</th>
                                        <th>Jabatan</th>
                                        <th width="120">Aksi</th>
                                    </tr>

                                </thead>

                                <tbody>

                                @forelse($anggotas as $index => $anggota)

                                    <tr>

                                        <td>{{ $index + 1 }}</td>

                                        <td>
                                            <strong>{{ $anggota->name }}</strong>
                                        </td>

                                        <td>
                                            {{ $anggota->no_anggota ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $anggota->divisi ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $anggota->jabatan ?? '-' }}
                                        </td>

                                        <td>

                                            <a href="{{ route('admin.ukm.anggota.profil', $anggota->id) }}"
                                               class="btn btn-info btn-sm">

                                                <i class="fas fa-eye"></i>
                                                Detail

                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="6" class="text-center py-5">

                                            <i class="fas fa-users-slash fa-3x text-secondary mb-3"></i>

                                            <h5 class="text-secondary">
                                                Belum ada anggota
                                            </h5>

                                            <p class="text-muted mb-0">
                                                Belum ada data anggota untuk UKM ini.
                                            </p>

                                        </td>

                                    </tr>

                                @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

@endsection