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
        Schema::table('empleado', function (Blueprint $table) {
            $table->string('password')->after('ActivoEmpleado');
            $table->string('remember_token', 100)->nullable()->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empleado', function (Blueprint $table) {
            $table->dropColumn(['password', 'remember_token']);
        });
    }
};
