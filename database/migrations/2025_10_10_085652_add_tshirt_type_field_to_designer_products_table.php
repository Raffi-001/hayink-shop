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
        Schema::table('designer_products', function (Blueprint $table) {
            $table->string('tshirt_type')->nullable();
            $table->json('colors')->nullable();
            $table->json('mockups')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('designer_products', function (Blueprint $table) {
            $table->dropColumn('tshirt_type');
            $table->dropColumn('colors');
            $table->dropColumn('mockups');
        });
    }
};
