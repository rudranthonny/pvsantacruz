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
        Schema::table('posventas', function (Blueprint $table) {
            $table->string('cliente_nit')->after('cliente_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posventas', function (Blueprint $table) {
            $table->dropColumn('cliente_nit');
        });
    }
};
