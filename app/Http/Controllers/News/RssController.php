<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\RssModel;
use App\Helpers\Feed;

use App\Models\MenuModel;
use App\Models\RssNewsModel;

class RssController extends Controller
{
    private $pathViewController = 'news.pages.rss.';  // slider
    private $controllerName     = 'rss';
    private $params             = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        // view()->share('title', 'Tin tức tổng hợp');
        // $rssModel   = new RssModel();
        // $menuModel     = new MenuModel();

        // $itemsRss   = $rssModel->listItems(null, ['task'   => 'news-list-items']);
        // $itemsMenu     = $menuModel->listItems(null, ['task'  => 'news-list-items']);

        // $data = Feed::read($itemsRss);

        // return view($this->pathViewController .  'index', [
        //     'items'   => $data,
        //     'itemsMenu'     => $itemsMenu,
        // ]);

        view()->share('title', "Tin tưc tổng hợp");
        $rssNewModel = new RssNewsModel();
        $menuModel     = new MenuModel();

        $itemRssNewModel = $rssNewModel->getAll();
        $itemsMenu     = $menuModel->listItems(null, ['task'  => 'news-list-items']);
        return view($this->pathViewController .  'index', [
            'items'   => $itemRssNewModel,
            'itemsMenu'     => $itemsMenu,
        ]);
    }

    public function getGold()
    {
        $itemsGold = Feed::getGold();
        return view($this->pathViewController .  'child-index.box-gold', [
            'itemsGold' => $itemsGold
        ]);
    }

    public function getCoin()
    {
        $itemsCoin = Feed::getCoin();
        return view($this->pathViewController .  'child-index.box-coin', [
            'itemsCoin' => $itemsCoin
        ]);
    }
}
