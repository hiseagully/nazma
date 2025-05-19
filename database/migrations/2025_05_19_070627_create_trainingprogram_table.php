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
        Schema::create('trainingprogram', function (Blueprint $table) {
            $table->id('trainingid'); // Primary key untuk tabel ini
            $table->foreignId('trainingregionid') // Foreign key
                  ->constrained('trainingregions', 'trainingid')
                  ->onDelete('cascade'); // Mengacu ke trainingregions.trainingid
            $table->string('trainingtitle', 50);
            $table->text('trainingdescription');
            $table->decimal('trainingpricerupiah', 10, 2);
            $table->decimal('trainingpricedollar', 10, 2);
            $table->string('trainingimage', 255);
            $table->dateTime('trainingschedule');
            $table->string('traininglocation', 255);
            $table->unsignedInteger('trainingslot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainingprogram');
    }
};