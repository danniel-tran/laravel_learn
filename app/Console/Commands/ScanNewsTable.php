<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\API;
use App\Models\RssNewsModel;

class ScanNewsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scans:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan news table and sync news with data in rss';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // cần làm một injection của controller để có thể gọi nó mà không cần qua HTTP
        Http::get("http://laravel-learn.test/api/scan-news");
        // $controller = new ScanNewsTable(new RssNewsModel());
        // $controller->index();
        // echo "successfull";
    }
}
