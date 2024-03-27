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
            $table->unsignedBigInteger('moneda_id')->nullable();
            $table->string('email_predeterminado')->nullable();
            $table->string('logo')->nullable();
            $table->string('name')->nullable();
            $table->string('telefono_empresa')->nullable();
            $table->string('desarrollador')->nullable();
            $table->string('pie_pagina')->nullable();
            $table->string('direccion')->nullable();
            $table->char('pagina_factura')->nullable()->default(0);
            $table->string('pie_pagina_factura')->nullable();
            $table->char('cotizacion_stock')->nullable()->default(0);
            $table->unsignedBigInteger('almacen_id')->nullable();
            $table->foreign('almacen_id')->references('id')->on('almacens');
            $table->foreign('moneda_id')->references('id')->on('monedas');
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
