<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMULIR PENDAFTARAN UKM - FMIPA USK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #555555;
            color: #ffffff;
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 0;
        }
        .form-card {
            width: 100%;
            max-width: 650px;
            background-color: #ffffff;
            color: #333333;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.3);
        }
        .form-card h3 {
            font-weight: bold;
            color: #e67e22;
            text-align: center;
            margin-bottom: 5px;
        }
        .form-control, .form-select {
            background-color: #f1f2f6;
            border: 1px solid #ced4da;
            padding: 12px;
            border-radius: 8px;
        }
        .form-control:focus, .form-select:focus {
            border-color: #e67e22;
            box-shadow: 0 0 0 0.25rem rgba(230, 126, 34, 0.25);
        }
        .btn-submit {
            background-color: #e67e22;
            color: #ffffff;
            font-weight: bold;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            border: none;
            transition: all 0.2s ease;
        }
        .btn-submit:hover {
            background-color: #d35400;
            color: #ffffff;
        }
        .info-box {
            background-color: #e8f4fd;
            border-left: 4px solid #3498db;
            padding: 10px 15px;
            border-radius: 4px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="form-card">
    <h3>Formulir Pendaftaran</h3>
    @if(session('error'))
        <div class="alert alert-danger" style="margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger" style="margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('mahasiswa.pendaftaran.simpan') }}" enctype="multipart/form-data">
    @csrf
    
    <input type="hidden" name="ukm_tujuan" value="{{ $ukmNama ?? '' }}">

    <div class="mb-3">
        <label class="form-label fw-semibold">UKM yang Dipilih</label>
        <input type="text" class="form-control" value="{{ $ukmNama ?? '' }}" readonly>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Pilih Divisi UKM</label>
        <select class="form-select @error('divisi_tujuan') is-invalid @enderror" id="divisi_select" name="divisi_tujuan" required>
            <option value="" disabled selected>-- Pilih Divisi --</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Alasan Bergabung</label>
        <textarea class="form-control @error('alasan') is-invalid @enderror" name="alasan" rows="3" required placeholder="Jelaskan motivasi Anda bergabung di divisi ini...">{{ old('alasan') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Alamat Lengkap</label>
        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="2" required placeholder="Tuliskan alamat tinggal saat ini...">{{ old('alamat') }}</textarea>
    </div>

    <div class="mb-4">
        <label class="form-label fw-semibold">Upload Foto/Bukti Pendaftaran</label>
        <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" required accept="image/*">
        <small class="text-muted">Format: JPG, PNG (Maks 2MB)</small>
    </div>

    <button type="submit" class="btn btn-submit shadow-sm">
        Kirim & Lanjut ke Grup WhatsApp
    </button>
</form>

<script>
    const divisiData = {
        "UKM SERAMOE": ["VOKAL", "MUSIK", "MULTIMEDIA", "TARI"],
        "UKM LDF ULUL ALBAB": ["DANUS", "HUMAS", "KADERISASI", "KEPUTRIAN", "PSDM SYIAR", "MEDIA"],
        "UKM BARRACUDA": ["MOUNTAINEERING", "CAVING / RC", "DIVING", "SAR"]
    };

    document.addEventListener("DOMContentLoaded", function() {
        const selectedUkm = "{{ $ukmNama ?? '' }}";
        const divisiSelect = document.getElementById("divisi_select");

        // Periksa apakah UKM ada dalam data sebelum mencoba mengaksesnya
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