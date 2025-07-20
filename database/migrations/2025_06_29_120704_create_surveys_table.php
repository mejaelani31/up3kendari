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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel permohonans
            $table->foreignId('permohonan_id')->constrained()->onDelete('cascade');
            
            $table->string('no_survey')->unique();
            $table->date('tanggal_survey');
            $table->string('foto_survey')->nullable();
            
            // Kolom ini "diwarisi" dari permohonan untuk mempermudah filter hak akses
            $table->string('unit_role');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
