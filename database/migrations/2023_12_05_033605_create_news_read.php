<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateNewsRead extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userread', function (Blueprint $table) {
            $table->integer("user_id");
            $table->unsignedBigInteger("news_id");
            $table->primary(["user_id", "news_id"]);
        });


        Schema::table('userread', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');  // if news is deletel => the data equivalent is removw too
            $table->foreign('news_id')->references('id')->on('rssnews')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userread');
    }
}
