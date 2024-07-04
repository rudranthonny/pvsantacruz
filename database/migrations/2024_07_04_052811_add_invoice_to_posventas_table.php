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
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('cinvoice_id')->nullable();
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('cinvoice_id')->references('id')->on('cinvoices')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posventas', function (Blueprint $table) {
            //
        });
    }
};
