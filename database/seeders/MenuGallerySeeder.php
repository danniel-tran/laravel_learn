<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class MenuGallerySeeder extends Seeder
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
                'name' => "Thư viện hình ảnh",
                "status" => "active",
                'ordering' => 3,
                'link' => route('gallery/view-gallery'),
                'type_menu' => '',
                'type_open' => "current",
                "created_at" => $now,
                'modified_at' => null
            ],
        ]);
    }
}
