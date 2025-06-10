<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('producttransactionitems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('product_id');
            $table->string('product_name');
            $table->integer('qty');
            $table->decimal('price', 12, 2);
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();

            $table->foreign('transaction_id')->references('id')->on('producttransactions')->onDelete('cascade');
            $table->foreign('product_id')->references('productid')->on('productcollection')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('producttransactionitems');
    }
};