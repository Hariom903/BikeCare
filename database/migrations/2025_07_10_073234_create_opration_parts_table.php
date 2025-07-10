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
        Schema::create('opration_parts', function (Blueprint $table) {
            $table->id();
            //booking_id
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->unsignedBigInteger('product_variant_id')->nullable();
            $table->unsignedBigInteger('bill_id')->nullable();
            $table->unsignedBigInteger('quantity')->default(1);
            $table->decimal('price', 10, 2)->default(0.00);
            $table->decimal('total', 10, 2)->default(0.00);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();

           


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opration_parts');
    }
};
