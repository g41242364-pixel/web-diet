<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('pengguna')->after('email');
            $table->integer('umur')->nullable()->after('role');
            $table->string('jenis_kelamin')->nullable()->after('umur');
            $table->boolean('is_online')->default(false)->after('jenis_kelamin'); 
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'umur', 'jenis_kelamin', 'is_online']);
        });
    }
};
