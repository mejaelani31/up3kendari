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
        Schema::create('company_units', function (Blueprint $table) {
            $table->id();
            $table->string('unit1_name');
            $table->string('unit1_code');
            $table->string('unit2_name')->nullable();
            $table->string('unit2_code')->nullable();
            $table->string('unit3_name')->nullable();
            $table->string('unit3_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_units');
    }
};