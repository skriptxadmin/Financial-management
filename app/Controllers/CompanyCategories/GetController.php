<?php

namespace App\Controllers\CompanyCategories;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GetController extends BaseController
{
     public function index()
    {

        return view('company-categories/list/index');
    }

    public function all()
    {
        $model = new \App\Models\CompanyCategory();

        $categories = $model->select('name, slug')->findAll();

        return $this->response->setJSON(compact('categories'));

    }
}
