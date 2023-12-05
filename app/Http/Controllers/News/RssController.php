<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\RssModel;
use App\Helpers\Feed;

use App\Models\MenuModel;
use App\Models\RssNewsModel;
use App\Models\UserReadModel;
use Illuminate\Support\Facades\Redirect;

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

    public function userRead(Request $request)
    {
        $rss_new_id = $request->rss_new_id;
        $rssNewItem = RssNewsModel::where("id", $rss_new_id)->first();
        $userInfo =  $request->session()->get('userInfo');
        if ($userInfo && $rssNewItem) {
            UserReadModel::findOrCreate($userInfo['id'], $rss_new_id);
            return Redirect::to($rssNewItem->link);
        }
        return redirect()->route($this->controllerName . "/index")->with("zvn_notify", "Không tìm thấy bài viêt");
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
        $userInfo =  $request->session()->get('userInfo');
        $listRssNews = UserReadModel::where('user_id', $userInfo['id'] ?? 0)->get()->toArray();
        $listNewsIdRead = array_map(function ($value) {
            return $value['news_id'];
        }, $listRssNews);

        $itemRssNewModel = array_map(function ($item) use ($userInfo, $listRssNews, $listNewsIdRead) {
            if (!$userInfo || !$listRssNews) {
                $item['isRead'] = false;
            }
            $item['isRead'] = in_array($item['id'], $listNewsIdRead);
            return $item;
        }, $itemRssNewModel);

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
