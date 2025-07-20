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
        Schema::create('permohonans', function (Blueprint $table) {
            $table->id();
            $table->string('id_pelanggan')->nullable();
            $table->string('jenis_permohonan'); // e.g., 'Pasang Baru', 'Tambah Daya'
            $table->string('nama_pemohon');
            $table->text('alamat_pemohon');
            $table->string('no_hp_pemohon');
            $table->string('titik_koordinat')->nullable();
            $table->string('tarif_lama')->nullable();
            $table->string('daya_lama')->nullable();
            $table->string('tarif_permohonan');
            $table->string('daya_permohonan');
            $table->string('status_permohonan')->default('MOHON');
            $table->string('status_survey')->default('00 : Input Permohonan');

            // Foreign data for tracking and filtering
            $table->string('user_email');
            $table->string('employee_nip');
            $table->string('unit_role'); // The key for hierarchical filtering
            $table->string('company_unit_name')->nullable(); // The unit name for display
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonans');
    }
};
