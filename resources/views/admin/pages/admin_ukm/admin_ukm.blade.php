@extends('admin.layouts.main_pengurus')

@section('content')

<div class="row">

    <div class="col-md-12">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">
                    Dashboard Admin Pengurus
                </h3>

            </div>

            <div class="card-body">

                Selamat datang {{ auth()->user()->name }}

            </div>

        </div>

    </div>

</div>

@endsection
```
