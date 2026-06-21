<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // <-- WAJIB ADA agar terhubung ke tabel users
            $table->string('nama_lengkap');
            $table->string('npm')->unique();
            $table->string('prodi');
            $table->string('email')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('angkatan')->nullable();
            
            // --- KOLOM BARU UNTUK INPUTAN UKM ---
            $table->string('ukm_tujuan');      // Menyimpan nama UKM pilihan (Seramoe / Ulul Albab / Barracuda)
            $table->string('divisi_tujuan');   // Menyimpan nama Divisi pilihan
            $table->text('alasan');            // Menyimpan alasan memilih ukm & divisi
            
            $table->text('alamat')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
