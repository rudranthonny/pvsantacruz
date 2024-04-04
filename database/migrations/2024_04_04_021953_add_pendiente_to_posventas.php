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
        Schema::table('posventas', function (Blueprint $table) {
            $table->double('monto_pendiente')->after('monto_pago')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posventas', function (Blueprint $table) {
            $table->dropColumn('monto_pendiente');
        });
    }
};
