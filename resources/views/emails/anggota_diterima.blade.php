<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Diterima</title>
</head>

<body style="font-family:Arial;background:#f4f4f4;padding:30px;">

<div style="max-width:650px;margin:auto;background:#ffffff;border-radius:10px;padding:40px">

    <h1 style="color:#198754;text-align:center">
        🎉 Selamat!
    </h1>

    <p>Halo <strong>{{ $user->name }}</strong>,</p>

    <p>
        Kami dengan senang hati memberitahukan bahwa
        pendaftaran Anda sebagai anggota
        <strong>{{ $ukm->nama_ukm }}</strong>
        telah <strong>DITERIMA</strong>.
    </p>

    <p>
        Akun Anda sekarang sudah aktif dan dapat digunakan
        untuk login ke Sistem Informasi UKM FMIPA USK.
    </p>

    <div style="text-align:center;margin-top:35px;margin-bottom:35px">

        <a href="{{ url('/login') }}"
           style="
                background:#198754;
                color:white;
                text-decoration:none;
                padding:14px 30px;
                border-radius:8px;
                font-size:18px;">
            Login Sekarang
        </a>

    </div>

    <hr>

    <p>
        Terima kasih telah bergabung bersama
        <strong>UKM FMIPA USK</strong>.
    </p>

</div>

</body>

</html>