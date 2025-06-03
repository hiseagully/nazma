<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('producttransactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('email');
            $table->string('name');
            $table->string('phone');
            $table->string('country'); // ID/INTL
            $table->string('province_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('district_id')->nullable();
            $table->string('country_name')->nullable();
            $table->string('city_name')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('address');
            $table->string('shipping_courier')->nullable();
            $table->decimal('shipping_cost', 12, 2)->default(0);
            $table->string('payment_method')->nullable();
            $table->string('payment_gateway')->nullable();
            $table->string('payment_status')->default('pending');
            $table->decimal('total_price', 12, 2)->default(0);
            $table->json('products'); // detail produk (id, qty, price, subtotal)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('producttransactions');
    }
};