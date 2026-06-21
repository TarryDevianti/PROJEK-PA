<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {

            $table->unsignedBigInteger('ukm_id')->nullable()->after('id');

        });
    }

    public function down(): void
    {
        Schema::table('pengurus', function (Blueprint $table) {

            $table->dropColumn('ukm_id');

        });
    }
};