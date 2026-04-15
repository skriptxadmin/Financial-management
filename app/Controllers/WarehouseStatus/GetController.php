<?php

namespace App\Controllers\WarehouseStatus;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GetController extends BaseController
{
     public function index()
    {

        return view('warehouse-status/list/index');
    }

    public function all()
    {
        $model = new \App\Models\WarehouseStatus();

        $status = $model->select('name, slug')->findAll();

        return $this->response->setJSON(compact('status'));

    }
}
