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
        Schema::table('users', function (Blueprint $table) {

            // relasi ke tabel ukms
            $table->unsignedBigInteger('ukm_id')
                  ->nullable()
                  ->after('id');

            // data anggota / pengurus
            $table->string('divisi')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('no_anggota')->nullable();

            // role user
            $table->enum('role', [
                'super_admin',
                'admin_pengurus',
                'anggota'
            ])->default('anggota');

            // foreign key
            $table->foreign('ukm_id')
                  ->references('id')
                  ->on('ukms')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropForeign(['ukm_id']);

            $table->dropColumn([
                'ukm_id',
                'divisi',
                'jabatan',
                'no_anggota',
                'role'
            ]);
        });
    }
};