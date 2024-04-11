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
            $table->double('total_pagar_previo')->default(0)->after('envio');
            $table->double('descuento_items')->default(0)->after('descuento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posventas', function (Blueprint $table) {
            $table->dropColumn('total_pagar_previo');
            $table->dropColumn('descuento_items');
        });
    }
};
