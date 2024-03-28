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
        Schema::create('posventa_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('posventa_id');
            $table->string('producto_id');
            $table->string('producto_codigo');
            $table->string('producto_nombre');
            $table->string('producto_precio');
            $table->string('producto_cantidad');
            $table->string('producto_importe');
            $table->string('producto_tipo');
            $table->foreign('posventa_id')->references('id')->on('posventas');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posventa_detalles');
    }
};
