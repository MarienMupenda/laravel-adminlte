<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToSellings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sellings', function (Blueprint $table) {
            $table->string('reference')->nullable();
            $table->foreignId('currency_id')->default(1)->nullable()->references('id')->on('currencies')->nullOnDelete();
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
            $table->dropForeign(['currency_id']);
            $table->dropColumn(['reference', 'currency_id']);
        });
    }
}
