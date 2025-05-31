<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productimages', function (Blueprint $table) {
            $table->id('productimageid'); // ID unik gambar
            $table->unsignedBigInteger('productid'); // FK ke produk
            $table->string('image_path'); // path atau nama file gambar
            $table->boolean('is_thumbnail')->default(false); // penanda gambar utama
            $table->timestamps(); // created_at & updated_at

            // Foreign key ke tabel productcollection
            $table->foreign('productid')
                ->references('productid')
                ->on('productcollection')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productimages');
    }
};