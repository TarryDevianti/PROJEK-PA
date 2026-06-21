@extends('admin_pengurus.layouts.main')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Detail Calon Anggota</h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th>Nama</th>
                <td>{{ $pendaftaran->nama_lengkap }}</td>
            </tr>

            <tr>
                <th>NPM</th>
                <td>{{ $pendaftaran->npm }}</td>
            </tr>

            <tr>
                <th>Email</th>
                <td>{{ $pendaftaran->email }}</td>
            </tr>

            <tr>
                <th>Divisi</th>
                <td>{{ $pendaftaran->divisi_tujuan }}</td>
            </tr>

            <tr>
                <th>Alamat</th>
                <td>{{ $pendaftaran->alamat }}</td>
            </tr>

            <tr>
                <th>Status</th>
                <td>
                    <span class="badge bg-warning">
                        {{ $pendaftaran->status }}
                    </span>
                </td>
            </tr>

        </table>

    </div>

</div>

@endsection