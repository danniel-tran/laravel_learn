<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminModel;
use Illuminate\Http\Request;

class GalleryController extends AdminController
{
    protected $pathViewController = 'admin.pages.gallery.';  // slider
    protected $controllerName     = 'gallery';
    protected $params             = [];
    protected $model;
    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }
    public function index(Request $request)
    {
        return view('admin.pages.gallery.index', []);
    }
}
