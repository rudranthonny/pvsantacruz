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
        Schema::create('cfacturas', function (Blueprint $table) {
            $table->id();
            $table->string('consultadpi');
            $table->string('facturacion');
            $table->string('anulacion');
            $table->string('consultafac');
            $table->integer('correlativo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cfacturas');
    }
};
