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
        Schema::create('configuracions', function (Blueprint $table) {
            $table->id();
            $table->string('moneda_predeterminada');
            $table->string('email_predeterminado');
            $table->string('logo')->nullable();
            $table->string('name');
            $table->string('telefono_empresa');
            $table->string('desarrollador');
            $table->string('pie_pagina');
            $table->string('direccion');
            $table->char('pagina_factura')->default(0);
            $table->string('pie_pagina_factura');
            $table->char('cotizacion_stock')->default(0);
            $table->unsignedBigInteger('almacen_id');
            $table->foreign('almacen_id')->references('id')->on('almacens');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracions');
    }
};
