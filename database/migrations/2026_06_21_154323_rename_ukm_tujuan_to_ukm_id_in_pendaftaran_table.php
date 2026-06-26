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
        Schema::table('pendaftaran', function (Blueprint $table) {
            // Rename kolom ukm_tujuan menjadi ukm_id
            $table->renameColumn('ukm_tujuan', 'ukm_id');
            
            // Jika sebelumnya tidak ada foreign key, tambahkan
            // $table->foreign('ukm_id')->references('id')->on('ukms')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            // Kembalikan ke nama sebelumnya
            $table->renameColumn('ukm_id', 'ukm_tujuan');
            
            // Jika ada foreign key, hapus dulu
            // $table->dropForeign(['ukm_id']);
        });
    }
};