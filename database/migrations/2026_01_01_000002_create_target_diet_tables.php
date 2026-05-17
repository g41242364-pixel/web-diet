<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('target_diets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('berat_target', 5, 2);
            $table->decimal('target_mingguan', 5, 2);
            $table->string('tujuan'); 
            $table->decimal('berat_awal', 5, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('diet_checkins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('target_diet_id')->constrained()->onDelete('cascade');
            $table->decimal('berat_sekarang', 5, 2);
            $table->text('catatan')->nullable();
            $table->date('tanggal_checkin');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diet_checkins');
        Schema::dropIfExists('target_diets');
    }
};
