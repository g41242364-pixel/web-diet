public function up(): void
{
    Schema::table('physical_activities', function (Blueprint $table) {
        $table->dropColumn('gambar');
        $table->string('link_youtube')->nullable()->after('lokasi');
    });
}

public function down(): void
{
    Schema::table('physical_activities', function (Blueprint $table) {
        $table->dropColumn('link_youtube');
        $table->string('gambar')->nullable()->after('lokasi');
    });
}