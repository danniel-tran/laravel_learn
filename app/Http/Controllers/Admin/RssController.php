<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Models\RssModel as MainModel;
use App\Http\Requests\RssRequest as MainRequest;

class RssController extends AdminController
{
    protected $pathViewController = 'admin.pages.rss.';
    protected $controllerName     = 'rss';
    protected $params             = [];
    protected $model;

    public function __construct()
    {
        $this->model = new MainModel();
        $this->params["pagination"]["totalItemsPerPage"] = 5;
        view()->share('controllerName', $this->controllerName);
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
}
