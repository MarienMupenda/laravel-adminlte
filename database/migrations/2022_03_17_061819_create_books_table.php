<?php

use App\Models\Item;
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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->mediumText('summary')->nullable();
            $table->string('author')->nullable();
            $table->string('edition')->nullable();
            $table->string('copyright')->nullable();
            $table->string('publisher')->nullable();
            $table->string('isbn')->nullable();
            $table->string('genres')->nullable();
            $table->date('published_at')->nullable();
            $table->foreignIdFor(Item::class);

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

        Schema::dropIfExists('books');
    }
};
