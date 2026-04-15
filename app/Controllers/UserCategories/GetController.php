<?php

namespace App\Controllers\UserCategories;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GetController extends BaseController
{
     public function index()
    {

        return view('user-categories/list/index');
    }

    public function all()
    {
        $model = new \App\Models\UserCategory();

        $categories = $model->select('name, slug')->findAll();

        return $this->response->setJSON(compact('categories'));

    }
}
