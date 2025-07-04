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
        Schema::table('users', function (Blueprint $table) {
     $table->unsignedBigInteger('franchises_id')->nullable(); // Add column if not exists

    $table->foreign('franchises_id')
          ->references('id')
          ->on('franchises')
          ->onDelete('cascade');
    });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
