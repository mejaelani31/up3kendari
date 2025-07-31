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
            $table->string('user_email')->nullable()->after('keterangan');
            $table->string('employee_nip')->nullable()->after('user_email');
            // Menghapus kolom unit_role yang lama jika ada, lalu menambahkannya kembali
            // untuk memastikan posisinya benar dan konsisten.
            $table->dropColumn('unit_role');
        });

        Schema::table('surveys', function (Blueprint $table) {
            $table->string('unit_role')->nullable()->after('employee_nip');
            $table->string('company_unit_name')->nullable()->after('unit_role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surveys', function (Blueprint $table) {
            $table->dropColumn(['user_email', 'employee_nip', 'company_unit_name']);
            // Mengembalikan kolom unit_role ke posisi lama jika di-rollback
            $table->dropColumn('unit_role');
        });
        Schema::table('surveys', function (Blueprint $table) {
            $table->string('unit_role')->after('foto_survey');
        });
    }
};
