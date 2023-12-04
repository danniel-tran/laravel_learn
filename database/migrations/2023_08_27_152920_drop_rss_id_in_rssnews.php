<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DropRssIdInRssnews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rssnews', function (Blueprint $table) {
            DB::statement('ALTER TABLE rssnews DROP FOREIGN KEY rssnews_rss_id_foreign');
            DB::statement('ALTER TABLE rssnews DROP COLUMN rss_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
