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
        Schema::create('trainingtransaction', function (Blueprint $table) {
            $table->id('trainingtransactionid');
            $table->string('trainingtransactionmethod', 100);
            $table->string('trainingtransactionstatus', 100);
            $table->dateTime('trainingtransactiondate');
            $table->decimal('trainingtransactiontotal', 10, 2);

            // Trainee Info
            $table->enum('transactiontraineegender', ['f', 'm']); // f = female, m = male
            $table->string('transactiontraineename');
            $table->integer('transactiontraineeage');
            $table->text('transactiontraineeaddress');

            // Foreign Keys
            $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('trainingid')->constrained('trainingprogram', 'trainingid')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainingtransaction');
    }
};