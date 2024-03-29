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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('imagen')->nullable();
            $table->string('designacion');
            $table->string('codigo')->nullable();
            $table->char('simbologia')->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->unsignedBigInteger('marca_id')->nullable();
            $table->double('impuesto_orden')->nullable();
            $table->string('metodo_impuesto');
            $table->string('descripcion')->nullable();
            $table->string('tipo')->nullable();
            $table->double('costo')->nullable();
            $table->double('precio')->nullable();
            $table->unsignedBigInteger('unitario');
            $table->unsignedBigInteger('venta_unidad');
            $table->unsignedBigInteger('compra_unidad');
            $table->integer('alerta_stock')->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('unitario')->references('id')->on('unidads');
            $table->foreign('venta_unidad')->references('id')->on('unidads');
            $table->foreign('compra_unidad')->references('id')->on('unidads');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
