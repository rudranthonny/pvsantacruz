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
        Schema::create('posventas', function (Blueprint $table) {
            $table->id();
            $table->string('almacen_id');
            $table->string('almacen_name');
            $table->string('cliente_id');
            $table->string('cliente_name');
            $table->string('impuesto_porcentaje');
            $table->string('impuesto_monto');
            $table->string('descuento');
            $table->string('envio');
            $table->string('total_pagar');
            $table->string('cantidad_recibida');
            $table->string('monto_pago');
            $table->string('cambio');
            $table->string('nota_venta');
            $table->string('nota_pago');
            $table->string('productos_totales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posventas');
    }
};
