<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sleep_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->time('jam_tidur');
            $table->time('jam_bangun');
            $table->decimal('durasi_jam', 4, 2);
            $table->string('status_tidur')->nullable();
            $table->text('catatan')->nullable();
            $table->date('tanggal');
            $table->timestamps();
        });

        // Aktivitas Fisik
        Schema::create('physical_activities', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('status_kebiasaan')->nullable();
            $table->string('durasi');
            $table->string('intensitas');
            $table->string('lokasi');
            $table->string('link_youtube')->nullable();
            $table->timestamps();
        });

        // Konsultasi
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('ahli_gizi_id')->constrained('users')->onDelete('cascade');
            $table->string('status')->default('aktif');
            $table->foreignId('screening_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });

        // Pesan Chat
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consultation_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('isi');
            $table->timestamps();
        });

        // Artikel
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('judul');
            $table->longText('isi');
            $table->string('gambar')->nullable();
            $table->string('rekomendasi_imt'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('consultations');
        Schema::dropIfExists('physical_activities');
        Schema::dropIfExists('sleep_logs');
    }
};
