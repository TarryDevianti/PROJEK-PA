@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h3>
        Daftar Anggota {{ $ukm->nama_ukm }}
    </h3>

    <table class="table table-bordered">

        <thead class="table-dark">

            <tr>
                <th width="60">No</th>
                <th>Nama</th>
                <th>No Anggota</th>
                <th>Divisi</th>
                <th>Jabatan</th>
            </tr>

        </thead>

        <tbody>

        @forelse($anggotas as $index => $anggota)

            <tr>

                <td>{{ $index + 1 }}</td>

                <td>{{ $anggota->nama_lengkap }}</td>

                <td>{{ $anggota->no_anggota ?? '-' }}</td>

                <td>{{ $anggota->divisi_tujuan ?? '-' }}</td>

                <td>{{ $anggota->jabatan ?? '-' }}</td>

            </tr>

        @empty

            <tr>
                <td colspan="5" class="text-center">
                    Belum ada anggota.
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection