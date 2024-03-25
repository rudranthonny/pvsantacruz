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
        Schema::create('m_cajas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tmovimiento_caja_id');
            $table->unsignedBigInteger('caja_id');
            $table->char('signo');
            $table->double('monto');
            $table->foreign('tmovimiento_caja_id')->references('id')->on('tmovimiento_cajas');
            $table->foreign('caja_id')->references('id')->on('cajas');

            $table->unsignedBigInteger('m_cajable_id');
            $table->string('m_cajable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_cajas');
    }
};
