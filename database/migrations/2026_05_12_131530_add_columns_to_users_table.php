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
        // Pastikan nama kolomnya 'program_studi', bukan 'prodi'
        $table->string('npm')->nullable()->after('id'); 
        $table->string('program_studi')->nullable()->after('email'); 
        $table->string('angkatan', 4)->nullable()->after('program_studi');
        $table->string('telepon')->nullable()->after('angkatan');
        $table->string('role')->default('anggota')->after('telepon');
        $table->boolean('is_active')->default(true)->after('role');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
