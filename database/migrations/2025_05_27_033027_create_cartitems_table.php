<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cartitems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('productid');
            $table->integer('quantity')->default(1);
            $table->timestamps();

            // cart_id mengacu ke id pada tabel carts
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            // productid mengacu ke productid pada tabel productcollection
            $table->foreign('productid')->references('productid')->on('productcollection')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cartitems');
    }
};