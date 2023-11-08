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
        Schema::create('tables', function (Blueprint $table) {
            $table->id('tableID');
            $table->unsignedBigInteger('restaurantID');
            $table->enum('status', ['Occupied', 'Vacant']);
            $table->string('location')->nullable();
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
        Schema::dropIfExists('tables');
    }
};
