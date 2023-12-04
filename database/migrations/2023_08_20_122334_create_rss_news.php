<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRssNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('rssNews', function (Blueprint $table) {
            $table->id();
            $table->integer('votes');
            $table->string("title");
            $table->string("thumb");
            $table->string("link");
            $table->string("pubDate");
            $table->string("description");
            $table->integer('rss_id');
        });
        Schema::table('rssNews', function (Blueprint $table) {
            $table->index('rss_id');
            $table->foreign('rss_id')->references('id')->on('rss')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rssNews');
    }
}
