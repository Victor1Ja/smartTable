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
        Schema::create('restaurant_tables', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('restaurantID');
            $table->unsignedInteger('number')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();

            // Define foreign key relationship with the Restaurant model
            $table->foreign('restaurantID')->references('id')->on('restaurants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
