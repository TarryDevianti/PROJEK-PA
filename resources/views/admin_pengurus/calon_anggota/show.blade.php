@extends('admin_pengurus.layouts.main')

@section('content')

<div class="card">

    <div class="card-header">
        <h3>Detail Calon Anggota</h3>
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
                <th>Prodi</th>
                <td>{{ $pendaftaran->prodi }}</td>
            </tr>

            <tr>
                <th>Divisi</th>
                <td>{{ $pendaftaran->divisi_tujuan }}</td>
            </tr>

            <tr>
                <th>Alasan</th>
                <td>{{ $pendaftaran->alasan }}</td>
            </tr>

            <tr>
                <th>Alamat</th>
                <td>{{ $pendaftaran->alamat }}</td>
            </tr>

            <tr>
                <th>Foto</th>
                <td>
                    <img src="{{ asset('storage/' . $pendaftaran->foto) }}"
                         width="200">
                </td>
            </tr>

        </table>

    </div>

</div>

@endsection