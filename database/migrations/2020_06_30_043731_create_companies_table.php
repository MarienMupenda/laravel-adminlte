<?php

use App\Models\Business;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->text('address')->nullable();
            $table->string('info_legale')->nullable();

            $table->foreignIdFor(Business::class);
            $table->foreignIdFor(Currency::class)->default(1);
            $table->foreignIdFor(User::class)->constrained();

            $table->enum('status', ['active', 'inactive'])->default('inactive');

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
        Schema::dropIfExists('companies');
    }
}
