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
        Schema::create('sale', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("client_id");
            $table->double("total");
            $table->double("discount");
            $table->unsignedBigInteger("status_id");
            $table->unsignedBigInteger("created_by");

            $table->foreign('client_id')->references('id')->on('client');
            $table->foreign('status_id')->references('id')->on('sale_status');
            $table->foreign('created_by')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale');
    }
};
