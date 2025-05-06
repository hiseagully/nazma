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
        Schema::create('training_transaction', function (Blueprint $table) {
            $table->id('training_transaction_id');
            $table->string('training_transaction_method', 100);
            $table->string('training_transaction_status', 100);
            $table->dateTime('training_transaction_date');
            $table->decimal('training_transaction_total', 10, 2);

            // Buyer Info
            $table->enum('transaction_buyer_gender', ['f', 'm']); // f = female, m = male
            $table->string('transaction_buyer_name');
            $table->integer('transaction_buyer_age');
            $table->text('transaction_buyer_address');

            // Foreign Keys
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('training_id')->constrained('training')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_transactions');
    }
};
