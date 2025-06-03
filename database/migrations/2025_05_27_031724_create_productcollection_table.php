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

            // foreign key harus sesuai dengan kolom 'id' di tabel referensi
            $table->unsignedBigInteger('productcatalogid');
            $table->unsignedBigInteger('productregionsid');

            $table->string('productname');
            $table->text('productdescription')->nullable();
            $table->decimal('productpricerupiah', 15, 2)->nullable();
            $table->decimal('productpricedollar', 15, 2)->nullable();
            $table->decimal('productweight', 8, 2)->nullable();
            $table->integer('productstock')->default(0);
            $table->timestamps();

            // ASUMSI: primary key di 'productcatalog' adalah kolom 'id'
            $table->foreign('productcatalogid')
                ->references('id') // <--- pastikan ini sesuai
                ->on('productcatalog')
                ->onDelete('cascade');

            // ASUMSI: primary key di 'productregionsmap' adalah kolom 'id'
            $table->foreign('productregionsid')
                ->references('id') // <--- pastikan ini sesuai
                ->on('productregionsmap')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productcollection');
    }
};
