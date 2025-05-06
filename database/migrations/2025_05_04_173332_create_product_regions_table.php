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
        // Product Regions
        Schema::create('product_regions', function (Blueprint $table) {
            $table->id('product_region_id');
            $table->string('product_region_city', 100);
            $table->string('product_region_province', 100);
            $table->string('product_region_country', 100);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_regions');
    }
};
