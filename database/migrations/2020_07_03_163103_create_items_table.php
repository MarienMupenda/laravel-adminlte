<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->default(1)->references('id')->on('companies')->onDelete('cascade');
            $table->foreignId('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('name');
            $table->text('image')->nullable();
            $table->double('initial_price')->nullable();
            $table->double('selling_price');
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
        Schema::dropIfExists('items');
    }
}
