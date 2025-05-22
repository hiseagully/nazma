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
        Schema::create('productcatalog', function (Blueprint $table) {
            $table->bigIncrements('productcatalogid'); // primary key
            $table->string('productcatalogimage');
            $table->string('productcatalogname');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productcatalog');
    }
};
