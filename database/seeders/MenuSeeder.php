<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = new DateTime();
        DB::table('menu')->insert([
            [
                'name' => "Trang chủ", "status" => "active", 'ordering' => 1, 'link' => '/' . config('zvn.url.prefix_news'), 'type_menu' => '', 'type_open' => "current", "created_at" => $now, 'modified_at' => $now
            ],
            [
                'name' => "Sản phẩm", "status" => "active", 'ordering' => 2, 'link' => '#', 'type_menu' => 'category_article', 'type_open' => "current", "created_at" => $now, 'modified_at' => $now
            ],
            [
                'name' => "Blog", "status" => "inactive", 'ordering' => 3, 'link' => '#', 'type_menu' => 'category_blog', 'type_open' => "current", "created_at" => $now, 'modified_at' => $now
            ],
            [
                'name' => "Tin tức tổng hợp", "status" => "active", 'ordering' => 4, 'link' => route('rss/index'), 'type_menu' => '', 'type_open' => "new_window", "created_at" => $now, 'modified_at' => $now
            ],
        ]);
    }
}
