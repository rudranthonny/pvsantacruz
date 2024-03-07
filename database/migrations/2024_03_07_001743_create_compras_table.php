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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string('fecha');
            $table->string('refe')->nullable();
            $table->string('prove')->nullable();
            $table->string('almacen')->nullable();
            $table->string('estado')->nullable();
            $table->string('total')->nullable();
            $table->string('pagado')->nullable();
            $table->string('debido')->nullable();
            $table->string('estado_pago')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
