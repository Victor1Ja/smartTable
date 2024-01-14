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
            $table->unsignedBigInteger('table_id');
            $table->unsignedBigInteger('user_id');
            $table->string('status');
            // $table->unsignedBigInteger('staffID')->nullable();
            $table->timestamps();

            // Define foreign key relationship with the Restaurant model
            $table->foreign('table_id')->references('id')->on('restaurant_tables');
            // $table->foreign('staffID')->references('id')->on('staff');
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('menuItem_id');
            $table->unsignedInteger('quantity');
            $table->string('status');
            $table->timestamps();

            // Define foreign key relationship with the Restaurant model
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('menuItem_id')->references('id')->on('menu_items');
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
