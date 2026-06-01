<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('physical_activities', function (Blueprint $table) {

            if (Schema::hasColumn('physical_activities', 'gambar')) {
                $table->dropColumn('gambar');
            }

            $table->string('link_youtube')->nullable()->after('lokasi');
        });
    }

    public function down(): void
    {
        Schema::table('physical_activities', function (Blueprint $table) {

            if (Schema::hasColumn('physical_activities', 'link_youtube')) {
                $table->dropColumn('link_youtube');
            }

            $table->string('gambar')->nullable()->after('lokasi');
        });
    }
};