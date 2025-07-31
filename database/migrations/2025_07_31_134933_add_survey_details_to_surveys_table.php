<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('surveys', function (Blueprint $table) {
            // Kolom-kolom baru
            $table->foreignId('petugas_survey_id')->nullable()->constrained('employees')->onDelete('set null')->after('tanggal_survey');
            $table->string('koordinat_survey')->nullable()->after('petugas_survey_id');
            $table->string('hasil_survey')->nullable()->after('koordinat_survey');
            $table->string('gambar_survey')->nullable()->after('foto_survey'); // PDF
            $table->integer('kebutuhan_jutr')->nullable()->after('gambar_survey');
            $table->integer('kebutuhan_trafo')->nullable()->after('kebutuhan_jutr');
            $table->integer('kebutuhan_jutm')->nullable()->after('kebutuhan_trafo');
            $table->text('detail_kebutuhan')->nullable()->after('kebutuhan_jutm');
            $table->text('keterangan')->nullable()->after('detail_kebutuhan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surveys', function (Blueprint $table) {
            $table->dropForeign(['petugas_survey_id']);
            $table->dropColumn([
                'petugas_survey_id', 'koordinat_survey', 'hasil_survey', 'gambar_survey',
                'kebutuhan_jutr', 'kebutuhan_trafo', 'kebutuhan_jutm',
                'detail_kebutuhan', 'keterangan'
            ]);
        });
    }
};
