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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id')->unique();
            $table->decimal('service_charge', 10, 2);
            $table->decimal('laber_charge', 10, 2)->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->string('status')->default('unpaid'); // Status can be 'unpaid', 'paid', etc.
            $table->string('payment_method')->nullable(); // e.g., 'cash', 'credit_card', etc.
            $table->foreign('booking_id')->references('id')->on('services');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
