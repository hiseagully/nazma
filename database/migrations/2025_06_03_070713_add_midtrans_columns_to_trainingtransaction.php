<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('trainingtransaction', function (Blueprint $table) {
            $table->string('transactiontraineeemail')->after('transactiontraineename');
            $table->string('payment_method', 100)->nullable()->after('transactiontraineeaddress');
            $table->string('midtrans_order_id')->unique()->nullable()->after('trainingtransactiontotal');
            $table->string('snap_token')->nullable()->after('midtrans_order_id');
        });
    }

    public function down()
    {
        Schema::table('trainingtransaction', function (Blueprint $table) {
            $table->dropColumn([
                'transactiontraineeemail',
                'payment_method',
                'midtrans_order_id',
                'snap_token',
            ]);
        });
    }
};
