<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("status");
            $table->string("ordering");
            $table->string("link");
            $table->string("type_menu");  // category_article | category_blog
            $table->string("type_open");  // new_window | new_tab | current
            $table->dateTime("created_at");
            $table->dateTime("modified_at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
