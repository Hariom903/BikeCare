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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('customerName');
            $table->string('phone');
            $table->string("email");
            $table->string("address");
            $table->string("bikeType");
            $table->string("bikeBrand");
            $table->string("bikeModel");
            $table->string("year");
            $table->date("preferredDate");
            $table->time("preferredTime");
            $table->enum('urgency',['normal','urgent','emergency']);
            $table->string("issues");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
