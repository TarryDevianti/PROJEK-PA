@extends('admin_pengurus.layouts.main')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between">
        <h3>Kontak UKM</h3>

        @if(!$kontak)
        <a href="{{ route('admin-pengurus.kontak.create') }}"
           class="btn btn-primary">
            Tambah Link Grup
        </a>
        @endif
    </div>

    <div class="card-body">

        @if($kontak)

        <table class="table table-bordered">

            <tr>
                <th>Link Grup WhatsApp</th>
                <td>
                    <a href="{{ $kontak->link_grup }}"
                       target="_blank">
                        {{ $kontak->link_grup }}
                    </a>
                </td>
            </tr>

        </table>

        <a href="{{ route('admin-pengurus.kontak.edit', $kontak->id) }}"
           class="btn btn-warning">
            Edit
        </a>

        <form action="{{ route('admin-pengurus.kontak.destroy', $kontak->id) }}"
              method="POST"
              class="d-inline">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger">
                Hapus
            </button>
        </form>

        @else

        <div class="alert alert-warning">
            Belum ada link grup WhatsApp.
        </div>

        @endif

    </div>

</div>

@endsection