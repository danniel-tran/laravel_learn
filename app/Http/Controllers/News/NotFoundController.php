<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;;

use App\Models\SliderModel;
use App\Models\ArticleModel;
use App\Models\CategoryModel;
use App\Models\MenuModel;

class NotFoundController extends Controller
{
    private $pathViewController = 'errors.';  // slider
    private $controllerName     = 'notFound';
    private $params             = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        $articleModel  = new ArticleModel();
        $menuModel     = new MenuModel();
        $itemsLatest   = $articleModel->listItems(null, ['task'  => 'news-list-items-latest']);
        $itemsMenu     = $menuModel->listItems(null, ['task'  => 'news-list-items']);

        return view($this->pathViewController .  'index', [
            'itemsLatest'   => $itemsLatest,
            'itemsMenu'     => $itemsMenu,
        ]);
    }
}
