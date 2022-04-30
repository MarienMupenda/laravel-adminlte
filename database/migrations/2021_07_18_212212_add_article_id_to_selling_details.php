<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArticleIdToSellingDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('selling_details', function (Blueprint $table) {
            $table->foreignId('article_id')->nullable()->references('id')->on('articles')->onDelete('cascade')->after('item_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('selling_details', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
            $table->dropColumn(['article_id']);
        });
    }
}
