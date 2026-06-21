@extends('admin_pengurus.layouts.main')

@section('content')

<div class="card">

    <div class="card-header">
        Tambah Link Grup WhatsApp
    </div>

    <div class="card-body">

        <form action="{{ route('admin-pengurus.kontak.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <label>Link Grup WhatsApp</label>

                <input type="text"
                       name="link_grup"
                       class="form-control">

            </div>

            <button class="btn btn-primary">
                Simpan
            </button>

        </form>

    </div>

</div>

@endsection