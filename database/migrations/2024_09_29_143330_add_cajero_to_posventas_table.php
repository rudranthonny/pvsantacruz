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
            $table->unsignedBigInteger('cajero_id')->nullable();
            $table->foreign('cajero_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posventas', function (Blueprint $table) {
            $table->dropForeign('posventas_cajero_id_foreign');
            $table->dropColumn('cajero_id');
        });
    }
};
