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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string('fecha');
            $table->unsignedBigInteger('proveedor_id');
            $table->unsignedBigInteger('almacen_id');
            $table->double('porcentaje_impuesto_orden')->default(0);
            $table->double('total_sin_impuesto')->default(0);
            $table->double('monto_impuesto_orden')->default(0);
            $table->double('monto_descuento')->default(0);
            $table->double('monto_envio')->default(0);
            $table->double('total')->default();
            $table->char('estado')->nullable();
            $table->longText('nota')->nullable();
            $table->double('pagado')->default(0);
            $table->double('debido')->default(0);
            $table->char('estado_pago')->default(1);
            $table->foreign('proveedor_id')->references('id')->on('proveedors');
            $table->foreign('almacen_id')->references('id')->on('almacens');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
