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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id('itemID');
            $table->unsignedBigInteger('restaurantID');
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('category');
            $table->string('image')->nullable();
            $table->timestamps();
            
            // Define foreign key relationship with the Restaurant model
            $table->foreign('restaurantID')->references('restaurantID')->on('restaurants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
