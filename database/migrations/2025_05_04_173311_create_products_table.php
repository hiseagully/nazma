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
         // Products
         Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->foreignId('product_category_id')->constrained('product_categories')->onDelete('cascade');
            $table->foreignId('product_region_id')->constrained('product_regions')->onDelete('cascade');
            $table->string('product_name', 100);
            $table->text('product_description');
            $table->decimal('product_price_rupiah', 10, 2);
            $table->decimal('product_price_dollar', 10, 2);
            $table->string('product_image', 255);
            $table->integer('product_stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
