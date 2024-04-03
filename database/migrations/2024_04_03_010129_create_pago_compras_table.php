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
        Schema::create('pago_compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compra_id');
            $table->date('fecha_pago');
            $table->string('opcion_pago');
            $table->double('cantidad_recibida');
            $table->double('monto_pago');
            $table->double('cambio');
            $table->longText('nota')->nullable();
            $table->foreign('compra_id')->references('id')->on('compras');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pago_compras');
    }
};
