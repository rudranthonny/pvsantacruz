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
        Schema::create('pago_relacionados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pago_deuda_id');
            $table->unsignedBigInteger('posventa_id');
            $table->double('monto');
            $table->foreign('pago_deuda_id')->references('id')->on('pago_deudas');
            $table->foreign('posventa_id')->references('id')->on('posventas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pago_relacionados');
    }
};
