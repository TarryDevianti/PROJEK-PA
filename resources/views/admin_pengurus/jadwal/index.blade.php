@extends('admin_pengurus.layouts.main')

@section('title', 'Jadwal')

@section('content')

<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="card-title m-0">
                Data Jadwal
            </h3>

            <a href="{{ route('admin-pengurus.jadwal.create') }}"
               class="btn btn-primary btn-sm">
                + Tambah
            </a>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Uraian</th>
                            <th>Sesi 1</th>
                            <th>Sesi 2</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($jadwal as $item)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                {{ $item->uraian }}
                            </td>

                            <td>
                                {{ $item->sesi_1_buka }}
                                <br>
                                s/d
                                <br>
                                {{ $item->sesi_1_tutup }}
                            </td>

                            <td>
                                {{ $item->sesi_2_buka }}
                                <br>
                                s/d
                                <br>
                                {{ $item->sesi_2_tutup }}
                            </td>

                            <td>

                                <a href="{{ route('admin-pengurus.jadwal.edit',$item->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('admin-pengurus.jadwal.delete',$item->id) }}"
                                      method="POST"
                                      style="display:inline-block">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin hapus jadwal?')">
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="5" class="text-center">
                                Belum ada jadwal
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection