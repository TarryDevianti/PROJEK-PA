@extends('admin_pengurus.layouts.main')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Detail Calon Anggota</h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="200">Nama Lengkap</th>
                <td>{{ $anggota->nama_lengkap }}</td>
            </tr>

            <tr>
                <th>NPM</th>
                <td>{{ $anggota->npm }}</td>
            </tr>

            <tr>
                <th>Program Studi</th>
                <td>{{ $anggota->prodi }}</td>
            </tr>

            <tr>
                <th>Email</th>
                <td>{{ $anggota->email }}</td>
            </tr>

            <tr>
                <th>No Telepon</th>
                <td>{{ $anggota->no_telepon }}</td>
            </tr>

            <tr>
                <th>Angkatan</th>
                <td>{{ $anggota->angkatan }}</td>
            </tr>

            <tr>
                <th>UKM Tujuan</th>
                <td>{{ $anggota->ukm_tujuan }}</td>
            </tr>

            <tr>
                <th>Divisi Tujuan</th>
                <td>{{ $anggota->divisi_tujuan }}</td>
            </tr>

            <tr>
                <th>Alamat</th>
                <td>{{ $anggota->alamat }}</td>
            </tr>

            <tr>
                <th>Motivasi</th>
                <td>{{ $anggota->motivasi }}</td>
            </tr>

            <tr>
                <th>Status</th>
                <td>
                    @if($anggota->status == 'diterima')
                        <span class="badge bg-success">
                            Diterima
                        </span>

                    @elseif($anggota->status == 'ditolak')
                        <span class="badge bg-danger">
                            Ditolak
                        </span>

                    @else
                        <span class="badge bg-warning text-dark">
                            Pending
                        </span>
                    @endif
                </td>
            </tr>

            <tr>
                <th>Tanggal Daftar</th>
                <td>
                    {{ $anggota->created_at->format('d M Y H:i') }}
                </td>
            </tr>

        </table>

        <div class="mt-3">

            <a href="{{ route('admin-pengurus.anggota') }}"
               class="btn btn-secondary">
                Kembali
            </a>

            @if($anggota->status == 'pending')

                <form action="{{ route('admin-pengurus.anggota.terima', $anggota->id) }}"
                      method="POST"
                      style="display:inline-block">

                    @csrf
                    @method('PUT')

                    <button type="submit"
                            class="btn btn-success">
                        Terima
                    </button>

                </form>

                <form action="{{ route('admin-pengurus.anggota.tolak', $anggota->id) }}"
                      method="POST"
                      style="display:inline-block">

                    @csrf
                    @method('PUT')

                    <button type="submit"
                            class="btn btn-danger">
                        Tolak
                    </button>

                </form>

            @endif

        </div>

    </div>

</div>

@endsection