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
            $table->unsignedBigInteger('product_category_id')->nullable();
            $table->foreignId('product_category_id')->references('product_category_id')->on('product_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('product_region_id')->nullable();
            $table->foreignId('product_region_id')->references('product_region_id')->on('product_regions')->onUpdate('cascade')->onDelete('cascade');
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
