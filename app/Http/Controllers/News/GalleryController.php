<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Helpers\ReadGallery;

use App\Models\MenuModel;
use App\Models\SliderModel;
use App\Models\ArticleModel;

class GalleryController extends Controller
{
    private $pathViewController = 'news.pages.gallery.';  // slider
    private $controllerName     = 'gallery';
    private $params             = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        $listGallery = ReadGallery::read();
        $menuModel     = new MenuModel();
        $sliderModel   = new SliderModel();
        $articleModel  = new ArticleModel();


        $itemsSlider   = $sliderModel->listItems(null, ['task'   => 'news-list-items']);
        $itemsMenu     = $menuModel->listItems(null, ['task'  => 'news-list-items']);
        $itemsLatest   = $articleModel->listItems(null, ['task'  => 'news-list-items-latest']);

        return view($this->pathViewController .  'index', [
            "listGallery"   => $listGallery,
            'itemsMenu'     => $itemsMenu,
            'itemsSlider'   => $itemsSlider,
            'itemsLatest'   => $itemsLatest,
        ]);
    }
}
