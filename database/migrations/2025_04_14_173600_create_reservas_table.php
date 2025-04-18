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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fingreso');
            $table->dateTime('fsalida');
            $table->integer('horas');
            $table->double('costo');
            $table->double('subtotal');
            $table->unsignedBigInteger('cancha_id');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('posventa_detalle_id')->nullable();
            $table->boolean('gratuito')->default(False);
            $table->enum('estado', ['Reservado','Utilizada','Anulada'])->default('Reservado');
            $table->longText('motivo_anulacion')->nullable();
            $table->boolean('activo')->default(TRUE);
            $table->foreign('cancha_id')->references('id')->on('canchas');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('posventa_detalle_id')->references('id')->on('posventa_detalles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
