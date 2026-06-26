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
        Schema::table('ukms', function (Blueprint $table) {
            // Tambahkan kolom user_id untuk relasi ke admin pengurus
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            
            // Tambahkan foreign key constraint (opsional)
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ukms', function (Blueprint $table) {
            // Hapus foreign key terlebih dahulu
            $table->dropForeign(['user_id']);
            // Hapus kolom
            $table->dropColumn('user_id');
        });
    }
};