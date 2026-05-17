<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->decimal('kalori', 8, 2);
            $table->decimal('protein', 8, 2)->default(0);
            $table->decimal('karbohidrat', 8, 2)->default(0);
            $table->decimal('lemak', 8, 2)->default(0);
            $table->string('gambar')->nullable();
            $table->timestamps();
        });

        Schema::create('meal_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status_imt');
            $table->string('kategori');
            $table->date('tanggal');
            $table->decimal('total_kalori', 8, 2)->default(0);
            $table->decimal('total_protein', 8, 2)->default(0);
            $table->decimal('total_karbohidrat', 8, 2)->default(0);
            $table->decimal('total_lemak', 8, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('meal_plan_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('meal_plan_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('food_id')
                ->constrained('foods')
                ->onDelete('cascade');

            $table->integer('porsi')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meal_plan_items');
        Schema::dropIfExists('meal_plans');
        Schema::dropIfExists('foods');
    }
};
