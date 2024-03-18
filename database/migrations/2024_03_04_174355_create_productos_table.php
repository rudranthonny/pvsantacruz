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
            $table->string('tipo')->nullable();
            $table->string('designacion');
            $table->string('codigo')->nullable();
            $table->double('precio')->nullable();
            $table->integer('cantidad')->nullable();
            $table->string('marca_id')->nullable();
            $table->string('categoria_id')->nullable();
            $table->string('unidad_id')->nullable();
            $table->timestamps();
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
