<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Pendaftaran Ditolak</title>
</head>

<body style="font-family:Arial;background:#f4f4f4;padding:30px;">

<div style="max-width:650px;margin:auto;background:white;padding:40px;border-radius:10px">

<h2 style="color:#dc3545;text-align:center">
❌ Informasi Pendaftaran
</h2>

<p>Halo <strong>{{ $user->name }}</strong>,</p>

<p>
Terima kasih telah mendaftar pada
<strong>{{ $ukm->nama_ukm }}</strong>.
</p>

<p>
Setelah melalui proses seleksi,
kami informasikan bahwa pendaftaran Anda
belum dapat kami terima pada periode ini.
</p>

<p>
Jangan berkecil hati.
Semoga Anda dapat mencoba kembali
pada periode berikutnya.
</p>

<hr>

<p>
Salam,
<br>
<strong>UKM FMIPA USK</strong>
</p>

</div>

</body>
</html>