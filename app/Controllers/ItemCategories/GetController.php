<?php

namespace App\Controllers\ItemCategories;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GetController extends BaseController
{
     public function index()
    {

        return view('item-categories/list/index');
    }

    public function all()
    {
        $model = new \App\Models\ItemCategory();

        $categories = $model->select('name, slug')->findAll();

        return $this->response->setJSON(compact('categories'));

    }
}
