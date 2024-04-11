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
        Schema::create('dcompracompuestos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dcompra_id');
            $table->unsignedBigInteger('producto_asignado_id');
            $table->double('cantidad');
            $table->foreign('dcompra_id')->references('id')->onDelete('cascade')->on('dcompras');
            $table->foreign('producto_asignado_id')->references('id')->onDelete('cascade')->on('productos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dcompracompuestos');
    }
};
