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
            $table->boolean('facturacion')->default(false);
            $table->boolean('rventas')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('configuracions', function (Blueprint $table) {
            $table->dropColumn('facturacion');
            $table->dropColumn('rventas');
        });
    }
};
