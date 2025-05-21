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
        Schema::create('reserva_usos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reserva_id')->constrained(); // la gratuita
            $table->foreignId('reserva_origen_id')->constrained('reservas'); // la pagada usada
            $table->integer('horas_utilizadas'); // cuántas horas tomó de esa reserva
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserva_usos');
    }
};
