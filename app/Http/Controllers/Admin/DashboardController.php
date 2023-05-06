<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;

class DashboardController extends AdminController
{
    protected $pathViewController = 'admin.pages.dashboard.';  // slider
    protected $controllerName     = 'dashboard';

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    public function index(Request $request)
    {
        return view($this->pathViewController .  'index', []);
    }
}
