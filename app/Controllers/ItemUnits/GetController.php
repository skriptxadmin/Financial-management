<?php

namespace App\Controllers\ItemUnits;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GetController extends BaseController
{
     public function index()
    {

        return view('item-units/list/index');
    }

    public function all()
    {
        $model = new \App\Models\ItemUnit();

        $itemUnits = $model->select('name, slug')->findAll();

        return $this->response->setJSON(compact('itemUnits'));

    }
}
