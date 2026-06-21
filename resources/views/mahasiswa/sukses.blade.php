@extends('admin.layouts.main')

@section('content')

<div class="container py-5">

```
<div class="card shadow">

    <div class="card-body text-center">

        <h2 class="text-success">
            Pendaftaran Berhasil ✓
        </h2>

        <p class="mt-3">
            Terima kasih telah mendaftar di
            <strong>{{ $ukm->nama_ukm }}</strong>
        </p>

        <p>
            Silakan bergabung ke grup WhatsApp untuk
            mendapatkan informasi lebih lanjut.
        </p>

        @if($kontak)

            <a href="{{ $kontak->link_grup }}"
               target="_blank"
               class="btn btn-success btn-lg">
                Gabung Grup WhatsApp
            </a>

        @endif

        <br><br>

        <a href="{{ route('dashboard') }}"
           class="btn btn-primary">
            Kembali ke Dashboard
        </a>

    </div>

</div>
```

</div>

@endsection
