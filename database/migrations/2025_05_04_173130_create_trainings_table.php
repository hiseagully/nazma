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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id('training_id'); // Primary key
            $table->foreignId('training_region_id')->constrained('training_regions')->onDelete('cascade'); // Foreign key

            $table->string('training_title', 50);
            $table->text('training_description');
            $table->decimal('training_price_rupiah', 10, 2);
            $table->decimal('training_price_dollar', 10, 2);
            $table->string('training_image', 255);
            $table->dateTime('training_schedule');
            $table->string('training_location', 255);
            $table->unsignedInteger('training_slot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
