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
        Schema::create('spbjs', function (Blueprint $table) {
            $table->id();
            $table->string('no_spbj')->unique();
            $table->date('tanggal');
            
            // Kolom untuk tracking dan hak akses
            $table->string('user_email');
            $table->string('employee_nip');
            $table->string('unit_role');
            $table->string('company_unit_name')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spbjs');
    }
};
