<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMULIR PENDAFTARAN UKM - FMIPA USK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #fdf8f2 0%, #f5ede6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0;
            font-family: 'Segoe UI', sans-serif;
        }
        .form-card {
            width: 100%;
            max-width: 650px;
            background-color: #ffffff;
            color: #3d2c1e;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            border: 1px solid rgba(212, 163, 115, 0.1);
        }
        .form-card h3 {
            font-weight: 700;
            color: #d4a373;
            text-align: center;
            margin-bottom: 5px;
            font-size: 1.8rem;
        }
        .form-card .subtitle {
            text-align: center;
            color: #8a7a6a;
            font-size: 0.9rem;
            margin-bottom: 25px;
        }
        .form-control, .form-select {
            background-color: #fdf8f2;
            border: 1px solid #e8ddd0;
            padding: 12px 16px;
            border-radius: 10px;
            color: #3d2c1e;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #d4a373;
            box-shadow: 0 0 0 4px rgba(212, 163, 115, 0.1);
        }
        .form-control:disabled, .form-control[readonly] {
            background-color: #f5ede6;
            color: #8a7a6a;
        }
        .form-label {
            font-weight: 600;
            color: #3d2c1e;
            font-size: 0.9rem;
        }
        .btn-submit {
            background: linear-gradient(135deg, #d4a373, #e9c46a);
            color: #3d2c1e;
            font-weight: 700;
            padding: 14px;
            border-radius: 12px;
            width: 100%;
            border: none;
            transition: all 0.3s ease;
            font-size: 1rem;
            box-shadow: 0 4px 15px rgba(212, 163, 115, 0.3);
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(212, 163, 115, 0.4);
            color: #3d2c1e;
        }
        .info-box {
            background-color: #f5ede6;
            border-left: 4px solid #d4a373;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 0.9rem;
            color: #8a7a6a;
            margin-bottom: 20px;
        }
        .info-box i {
            color: #d4a373;
            margin-right: 8px;
        }
        .alert-danger {
            border-radius: 10px;
            border: none;
            background: #fef2f2;
            color: #dc2626;
            border-left: 4px solid #dc2626;
        }
        .divider {
            border-top: 1px solid #e8ddd0;
            margin: 20px 0;
        }
        .form-card .logo-area {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-card .logo-area img {
            height: 60px;
        }
        @media (max-width: 768px) {
            .form-card {
                padding: 25px;
                margin: 15px;
            }
            .form-card h3 {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>

<div class="form-card">
    <div class="logo-area">
        <img src="{{ asset('assets/img/logofmipa.png') }}" alt="Logo FMIPA" style="height: 60px;">
    </div>
    <h3>Formulir Pendaftaran</h3>
    <p class="subtitle">Isi data dengan lengkap untuk bergabung menjadi anggota UKM</p>

    @if(session('error'))
        <div class="alert alert-danger" style="margin-bottom: 20px;">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger" style="margin-bottom: 20px;">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <ul style="margin: 5px 0 0 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="info-box">
        <i class="bi bi-info-circle"></i>
        Pastikan data yang Anda isi sudah benar. Formulir ini hanya bisa diisi sekali.
    </div>

    <form method="POST" action="{{ route('mahasiswa.pendaftaran.simpan') }}" enctype="multipart/form-data">
        @csrf
        
        <input type="hidden" name="ukm_id" value="{{ $ukm->id }}">

        <!-- Data Diri (Readonly) -->
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" value="{{ $user->name }}" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label">NPM</label>
                <input type="text" class="form-control" value="{{ $user->npm }}" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label">Program Studi</label>
                <input type="text" class="form-control" value="{{ $user->program_studi }}" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label">Angkatan</label>
                <input type="text" class="form-control" value="{{ $user->angkatan }}" readonly>
            </div>
        </div>

        <div class="divider"></div>

        <!-- Data Pendaftaran -->
        <div class="mb-3">
            <label class="form-label">UKM yang Dipilih</label>
            <input type="text" class="form-control" value="{{ $ukm->nama_ukm }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Pilih Divisi UKM</label>
            <select class="form-select @error('divisi_tujuan') is-invalid @enderror" id="divisi_select" name="divisi_tujuan" required>
                <option value="" disabled selected>-- Pilih Divisi --</option>
            </select>
            @error('divisi_tujuan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Alasan Bergabung</label>
            <textarea class="form-control @error('alasan') is-invalid @enderror" name="alasan" rows="3" required placeholder="Jelaskan motivasi Anda bergabung di divisi ini...">{{ old('alasan') }}</textarea>
            @error('alasan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Lengkap</label>
            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="2" required placeholder="Tuliskan alamat tinggal saat ini...">{{ old('alamat') }}</textarea>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Upload Foto/Bukti Pendaftaran</label>
            <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" required accept="image/*">
            <small class="text-muted">Format: JPG, PNG (Maks 2MB)</small>
            @error('foto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-submit">
            <i class="bi bi-send me-2"></i> Kirim & Lanjut ke Grup WhatsApp
        </button>
    </form>
</div>

<script>
    const divisiData = {
        "UKM SERAMOE": ["VOKAL", "MUSIK", "MULTIMEDIA", "TARI"],
        "UKM LDF ULUL ALBAB": ["DANUS", "HUMAS", "KADERISASI", "KEPUTRIAN", "PSDM SYIAR", "MEDIA"],
        "UKM BARRACUDA": ["MOUNTAINEERING", "CAVING / RC", "DIVING", "SAR"]
    };

    document.addEventListener("DOMContentLoaded", function() {
        const selectedUkm = "{{ $ukm->nama_ukm }}";
        const divisiSelect = document.getElementById("divisi_select");

        // Tambahkan option default
        const defaultOption = document.createElement("option");
        defaultOption.value = "";
        defaultOption.text = "-- Pilih Divisi --";
        defaultOption.disabled = true;
        defaultOption.selected = true;
        divisiSelect.appendChild(defaultOption);

        // Cari divisi berdasarkan UKM
        if (selectedUkm && divisiData[selectedUkm]) {
            divisiData[selectedUkm].forEach(function(divisi) {
                const option = document.createElement("option");
                option.value = divisi;
                option.text = divisi;
                divisiSelect.appendChild(option);
            });
        }
    });
</script>

</body>
</html>