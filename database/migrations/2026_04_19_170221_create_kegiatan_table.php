<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ukm_id')->constrained('ukms')->onDelete('cascade');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->date('tanggal_kegiatan')->nullable();
            $table->string('lokasi')->nullable();
            $table->enum('status', ['draft', 'published'])->default('published');
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kegiatans');
    }
};