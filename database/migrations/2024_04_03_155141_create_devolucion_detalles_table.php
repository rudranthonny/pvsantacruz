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
        Schema::create('devolucion_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('devolucion_id');
            $table->unsignedBigInteger('detalle_id');
            $table->string('producto_id');
            $table->string('producto_codigo');
            $table->string('producto_nombre');
            $table->double('producto_precio');
            $table->double('producto_cantidad');
            $table->double('producto_importe');
            $table->string('producto_tipo');
            $table->foreign('detalle_id')->references('id')->on('posventa_detalles');
            $table->foreign('devolucion_id')->references('id')->on('devolucions');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devolucion_detalles');
    }
};
