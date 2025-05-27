<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productcollection', function (Blueprint $table) {
            $table->id('productid');
            $table->unsignedBigInteger('productcatalogid');
            $table->unsignedBigInteger('productregionsid');
            $table->string('productname');
            $table->text('productdescription')->nullable();
            $table->decimal('productpricerupiah', 15, 2)->nullable();
            $table->decimal('productpricedollar', 15, 2)->nullable();
            $table->decimal('productweight', 8, 2)->nullable();
            $table->integer('productstock')->default(0);
            $table->timestamps();

            // Foreign key ke tabel productcatalog (kolom: productcatalogid)
            $table->foreign('productcatalogid')
                ->references('productcatalogid')
                ->on('productcatalog')
                ->onDelete('cascade');

            // Foreign key ke tabel productregionsmap (kolom: productregionsid)
            $table->foreign('productregionsid')
                ->references('productregionsid')
                ->on('productregionsmap')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};