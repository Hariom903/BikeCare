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
         Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('size_or_type'); // e.g., 250ml, Heavy Duty
            $table->string('unit')->nullable(); // e.g., ml, litre, pcs
            $table->integer('quantity_in_stock')->default(0);
            $table->decimal('unit_price', 10, 2)->default(0);
            $table->integer('reorder_level')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
