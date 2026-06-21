@extends('admin_pengurus.layouts.main')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Profil Admin Pengurus
        </h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th>Nama</th>
                <td>{{ $user->name }}</td>
            </tr>

            <tr>
                <th>Email</th>
                <td>{{ $user->email }}</td>
            </tr>

            <tr>
                <th>NPM</th>
                <td>{{ $user->npm }}</td>
            </tr>

            <tr>
                <th>Program Studi</th>
                <td>{{ $user->program_studi }}</td>
            </tr>

            <tr>
                <th>UKM</th>
                <td>{{ $user->ukm->nama_ukm ?? '-' }}</td>
            </tr>

        </table>

    </div>

</div>

@endsection