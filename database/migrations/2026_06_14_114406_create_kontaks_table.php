<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontaks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ukm_id');
            $table->text('link_grup');
            $table->timestamps();

            $table->foreign('ukm_id')
                ->references('id')
                ->on('ukms')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontaks');
    }
};