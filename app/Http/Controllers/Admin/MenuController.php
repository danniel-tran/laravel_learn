<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\MenuModel as MainModel;
use App\Models\CategoryModel;
use App\Http\Requests\ArticleRequest as MainRequest;

class MenuController extends AdminController
{
    protected $pathViewController = 'admin.pages.menu.';  // slider
    protected $controllerName     = 'menu';
    protected $params             = [];
    protected $model;

    public function __construct()
    {
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerPage"] = 5;
        view()->share('controllerName', $this->controllerName);
    }
    
    public function form(Request $request)
    {
        $item = null;
        if ($request->id !== null) {
            $params["id"] = $request->id;
            $item = $this->model->getItem($params, ['task' => 'get-item']);
        }

        $categoryModel  = new CategoryModel();
        $itemsCategory  = $categoryModel->listItems(null, ['task' => 'admin-list-items-in-selectbox']);

        return view($this->pathViewController .  'form', [
            'item'        => $item,
            'itemsCategory' => $itemsCategory
        ]);
    }

    public function save(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();

            $task   = "add-item";
            $notify = "Thêm phần tử thành công!";

            if ($params['id'] !== null) {
                $task   = "edit-item";
                $notify = "Cập nhật phần tử thành công!";
            }
            $this->model->saveItem($params, ['task' => $task]);
            return redirect()->route($this->controllerName)->with("zvn_notify", $notify);
        }
    }

    public function typeOpen(Request $request)
    {
        $params["currentType"]    = $request->type_open;
        $params["id"]             = $request->id;
        $this->model->saveItem($params, ['task' => 'change-type-open']);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function typeMenu(Request $request)
    {
        $params["currentType"]    = $request->type_menu;
        $params["id"]             = $request->id;
        $this->model->saveItem($params, ['task' => 'change-type-menu']);
        return response()->json([
            'status' => 'success'
        ]);
    }
}
