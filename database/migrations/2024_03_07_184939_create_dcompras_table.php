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
        Schema::create('dcompras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_producto');
            $table->double('costo_unitario');
            $table->integer('cantidad');
            $table->double('descuento')->default(0);
            $table->double('impuesto')->default(0);
            $table->double('total_parcial');
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('compra_id');
            $table->foreign('compra_id')->references('id')->on('compras');
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dcompras');
    }
};
