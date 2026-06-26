<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ukms', function (Blueprint $table) {
            $table->string('link_grup')->nullable()->after('logo');
        });
    }

    public function down(): void
    {
        Schema::table('ukms', function (Blueprint $table) {
            $table->dropColumn('link_grup');
        });
    }
};