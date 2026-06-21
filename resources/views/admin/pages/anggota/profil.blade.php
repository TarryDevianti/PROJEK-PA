@extends('admin.layouts.main')

@section('content')
<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-center p-4">
                <div class="card-body">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($anggota->name) }}&size=128"
                         class="rounded-circle mb-3 shadow-sm">

                    <h4 class="fw-bold mb-1">{{ $anggota->name }}</h4>
                    <p class="text-muted small mb-3">{{ $anggota->email }}</p>

                    <span class="badge bg-primary px-3">
                        {{ $anggota->jabatan ?? 'Anggota' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold">Detail Profil Anggota</h5>
                </div>

                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td width="30%" class="text-muted">Nama Lengkap</td>
                            <td class="fw-bold">: {{ $anggota->name }}</td>
                        </tr>

                        <tr>
                            <td class="text-muted">Nomor Anggota</td>
                            <td>: {{ $anggota->no_anggota ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td class="text-muted">Asal UKM</td>
                            <td>
                                : <span class="text-primary fw-bold">
                                    {{ $anggota->ukm->nama_ukm ?? '-' }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td class="text-muted">Divisi</td>
                            <td>: {{ $anggota->divisi ?? '-' }}</td>
                        </tr>

                        <tr>
                            <td class="text-muted">Jabatan</td>
                            <td>: {{ $anggota->jabatan ?? '-' }}</td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        @if($anggota->ukm_id)
                            <a href="{{ route('admin.ukm.anggota', ['ukm_id' => $anggota->ukm_id]) }}"
                               class="btn btn-secondary px-4">
                                Kembali
                            </a>
                        @else
                            <a href="{{ route('admin.dashboard') }}"
                               class="btn btn-secondary px-4">
                                Kembali ke Dashboard
                            </a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection