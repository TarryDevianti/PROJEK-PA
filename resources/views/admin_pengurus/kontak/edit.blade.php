@extends('admin_pengurus.layouts.main')

@section('content')

<div class="card">

    <div class="card-header">
        Edit Link Grup WhatsApp
    </div>

    <div class="card-body">

        <form action="{{ route('admin-pengurus.kontak.update', $kontak->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Link Grup WhatsApp</label>

                <input type="text"
                       name="link_grup"
                       class="form-control"
                       value="{{ $kontak->link_grup }}">

            </div>

            <button class="btn btn-success">
                Update
            </button>

        </form>

    </div>

</div>

@endsection