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
       Schema::table('opration_parts',function(Blueprint $table){

        $table->string('SGST')->nullable();
        $table->string('CGST')->nullable();

       });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
