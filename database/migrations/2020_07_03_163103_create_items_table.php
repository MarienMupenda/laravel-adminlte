<?php

use App\Models\Category;
use App\Models\Company;
use App\Models\Currency;
use App\Models\Unit;
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
            $table->string('slug')->unique()->nullable();
            $table->string('image')->nullable();
            $table->double('price');
            $table->double('quantity');

            $table->foreignIdFor(Currency::class);
            $table->foreignIdFor(Unit::class);
            $table->foreignIdFor(Category::class)->nullable();
            $table->foreignIdFor(Company::class);

            $table->enum('status', ['draft', 'published', 'unpublished'])->default('draft');

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
        Schema::dropIfExists('items');
    }
}
