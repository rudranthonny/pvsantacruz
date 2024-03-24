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
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->unsignedBigInteger('almacen_id');
            $table->unsignedBigInteger('tgasto_id');
            $table->double('monto');
            $table->longText('detalles')->nullable();
            $table->foreign('almacen_id')->references('id')->on('almacens');
            $table->foreign('tgasto_id')->references('id')->on('tgastos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gastos');
    }
};
