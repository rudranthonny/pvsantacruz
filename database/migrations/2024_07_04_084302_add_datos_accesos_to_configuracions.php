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
        Schema::table('configuracions', function (Blueprint $table) {
            $table->string('eco_cliente')->nullable();
            $table->string('eco_usuario')->nullable();
            $table->string('clave')->nullable();
            $table->string('Nitemisor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('configuracions', function (Blueprint $table) {
            $table->dropColumn('eco_cliente');
            $table->dropColumn('eco_usuario');
            $table->dropColumn('clave');
            $table->dropColumn('nitemisor');
        });
    }
};
