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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->integer('price');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('product_id')->nullable(); // Clave foránea para Product
            $table->foreign('product_id')->references('id')->on('products'); // Clave foránea para Product
            $table->unsignedBigInteger('appointment_id')->nullable(); // Clave foránea para Appointment
            $table->foreign('appointment_id')->references('id')->on('appointments'); // Clave foránea para Appointment
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
