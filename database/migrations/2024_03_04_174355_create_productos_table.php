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
            $table->string('marca')->nullable();
            $table->string('categoria')->nullable();
            $table->string('precio')->nullable();
            $table->string('unidad')->nullable();
            $table->string('cantidad')->nullable();
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
