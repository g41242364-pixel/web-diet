<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('pertanyaan');
            $table->tinyInteger('fase')->default(1);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('question_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->string('jawaban');
            $table->tinyInteger('skor')->default(1); // 1–4 (a=1, b=2, c=3, d=4)
            $table->timestamps();
        });

        Schema::create('screenings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('berat_badan', 5, 2);
            $table->decimal('tinggi_badan', 5, 2);
            $table->decimal('imt', 5, 2);
            $table->string('status_imt');
            $table->tinyInteger('total_skor')->default(0);
            $table->string('status_kebiasaan')->nullable();
            $table->timestamps();
        });

        Schema::create('screening_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('screening_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_option_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('screening_answers');
        Schema::dropIfExists('screenings');
        Schema::dropIfExists('question_options');
        Schema::dropIfExists('questions');
    }
};
