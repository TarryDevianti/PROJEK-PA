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
    Schema::create('galeris', function (Blueprint $table) {
        $table->id();
        $table->foreignId('ukm_id')->constrained('ukms')->onDelete('cascade');
        $table->string('judul');
        $table->string('foto'); // menyimpan path file foto
        $table->text('deskripsi')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeris');
    }
};
