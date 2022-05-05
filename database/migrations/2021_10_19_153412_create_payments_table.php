<?php

use App\Models\Currency;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->double('amount');
            $table->string("reference")->unique();
            $table->string("financial_institution_id")->nullable();
            $table->enum('action', ['debit', 'credit', 'verify',])->default('debit');
            $table->enum('method', ['bank_transfer', 'cash', 'mpesa', 'airtel', 'orange', 'credit_card', 'paypal', 'bitcoin', 'other',])->default('other');
            $table->foreignIdFor(Currency::class);
            $table->enum('status', ['pending', 'processing', 'done', 'failed'])->default('pending');
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Order::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
