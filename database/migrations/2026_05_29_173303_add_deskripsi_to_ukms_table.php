<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('ukms', function (Blueprint $table) {
        // Menambahkan kolom deskripsi setelah kolom slug (opsional)
        $table->text('deskripsi')->nullable()->after('slug');
    });
}

        public function down()
        {
            Schema::table('ukms', function (Blueprint $table) {
                $table->dropColumn('deskripsi');
            });
        }
};
