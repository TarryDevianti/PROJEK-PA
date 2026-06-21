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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();

            // UKM yang memiliki jadwal
            $table->string('ukm_slug');

            // Nama kegiatan jadwal
            $table->string('uraian');

            // Sesi 1
            $table->date('sesi_1_buka')->nullable();
            $table->date('sesi_1_tutup')->nullable();

            // Sesi 2
            $table->date('sesi_2_buka')->nullable();
            $table->date('sesi_2_tutup')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};