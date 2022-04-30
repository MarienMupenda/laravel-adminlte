<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Items::class);
            $table->string('subtitle');
            $table->string('author');
            $table->string('edition');
            $table->string('copyright')->nullable();
            $table->string('publisher');
            $table->string('isbn')->nullable();
            $table->string('genres')->nullable();
            $table->date('published_at')->nullable();
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

        Schema::dropIfExists('books');
    }
};