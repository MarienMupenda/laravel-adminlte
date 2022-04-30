<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSellingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sellings', function (Blueprint $table) {
            $table->enum('state', ['pending', 'paid', 'delivered', 'consumed', 'cancelled'])->default('pending')->after('paid');
            $table->foreignId('customer_id')->nullable()->constrained();
            $table->enum('payment_method', ['cash', 'mpesa', 'airtel', 'orange'])->default('cash');
            $table->bigInteger('paymentId')->nullable();
            $table->mediumText('note')->nullable();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sellings', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropColumn([
                'state',
                'note',
                'customer_id',
                'payment_method',
                'paymentId'
            ]);
            $table->dropSoftDeletes();
        });
    }
}
