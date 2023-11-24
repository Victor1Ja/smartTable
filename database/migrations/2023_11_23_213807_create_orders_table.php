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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tableID');
            $table->unsignedBigInteger('userID');
            $table->string('status');
            // $table->unsignedBigInteger('staffID')->nullable();
            $table->timestamps();

            // Define foreign key relationship with the Restaurant model
            $table->foreign('tableID')->references('id')->on('restaurant_tables');
            // $table->foreign('staffID')->references('id')->on('staff');
            $table->foreign('userID')->references('id')->on('users');
        });
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orderID');
            $table->unsignedBigInteger('menuItemID');
            $table->unsignedInteger('quantity');
            $table->string('status');
            $table->timestamps();

            // Define foreign key relationship with the Restaurant model
            $table->foreign('orderID')->references('id')->on('orders');
            $table->foreign('menuItemID')->references('id')->on('menu_items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('orderItems');
    }
};
