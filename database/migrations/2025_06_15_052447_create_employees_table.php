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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->unique()->constrained()->onDelete('set null');
            $table->string('nip')->unique();
            $table->string('nama');
            $table->string('bidang')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('unit1')->nullable();
            $table->string('unit2')->nullable();
            $table->string('unit3')->nullable();
            $table->string('role')->nullable();
            $table->string('unit_role')->nullable(); // Nama kolom disesuaikan dari 'unit-role'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
