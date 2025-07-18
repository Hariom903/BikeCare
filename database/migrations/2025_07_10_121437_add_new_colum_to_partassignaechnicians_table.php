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
        Schema::table('partassigntechnicians', function (Blueprint $table) {

            $table->string('created_by')->nullable()->after('price');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partassigntechnicians', function (Blueprint $table) {

            $table->dropColumn('created_by');
        });
    }
};
