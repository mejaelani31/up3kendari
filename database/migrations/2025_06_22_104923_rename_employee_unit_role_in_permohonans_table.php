<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('permohonans', function (Blueprint $table) {
            $table->renameColumn('employee_unit_role', 'unit_role');
        });
    }
    public function down(): void {
        Schema::table('permohonans', function (Blueprint $table) {
            $table->renameColumn('unit_role', 'employee_unit_role');
        });
    }
};
