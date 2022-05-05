<?php

use App\Models\Currency;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->double('quantity');
            $table->double('price');
            $table->double('discount')->nullable();
            $table->double('tax')->nullable();

            $table->foreignIdFor(Order::class);
            $table->foreignIdFor(Item::class);
            $table->foreignIdFor(Currency::class);

            $table->timestamps();
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
        Schema::dropIfExists('order_items');
    }
};
