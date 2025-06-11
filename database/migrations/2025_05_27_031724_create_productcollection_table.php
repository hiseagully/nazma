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

            // foreign key harus sesuai dengan kolom di tabel referensi
            $table->unsignedBigInteger('productcatalogid');
            $table->unsignedBigInteger('productregionsid');

            $table->string('productname');
            $table->text('productdescription')->nullable();
            $table->decimal('productpricerupiah', 15, 2)->nullable();
            $table->decimal('productpricedollar', 15, 2)->nullable();
            $table->decimal('productweight', 8, 2)->nullable();
            $table->integer('productstock')->default(0);
            $table->timestamps();

            // foreign key ke kolom 'productcatalogid' di productcatalog
            $table->foreign('productcatalogid')
                ->references('productcatalogid')
                ->on('productcatalog')
                ->onDelete('cascade');

            // foreign key ke kolom 'productregionsid' di productregionsmap
            $table->foreign('productregionsid')
                ->references('productregionsid')
                ->on('productregionsmap')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productcollection');
    }
};
