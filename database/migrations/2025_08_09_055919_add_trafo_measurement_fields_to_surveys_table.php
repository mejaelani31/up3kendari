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
            $table->string('trafo_existing')->nullable()->after('keterangan');
            $table->date('tanggal_ukur_trafo_existing')->nullable()->after('trafo_existing');
            $table->string('beban_trafo_existing')->nullable()->after('tanggal_ukur_trafo_existing');
            $table->decimal('hasil_ukur_r', 8, 2)->nullable()->after('beban_trafo_existing');
            $table->decimal('hasil_ukur_s', 8, 2)->nullable()->after('hasil_ukur_r');
            $table->decimal('hasil_ukur_t', 8, 2)->nullable()->after('hasil_ukur_s');
            $table->decimal('hasil_ukur_v', 8, 2)->nullable()->after('hasil_ukur_t');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surveys', function (Blueprint $table) {
            $table->dropColumn([
                'trafo_existing',
                'tanggal_ukur_trafo_existing',
                'beban_trafo_existing',
                'hasil_ukur_r',
                'hasil_ukur_s',
                'hasil_ukur_t',
                'hasil_ukur_v',
            ]);
        });
    }
};
