<?php

namespace App\Controllers\InvoiceStatus;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GetController extends BaseController
{
     public function index()
    {

        return view('invoice-status/list/index');
    }

    public function all()
    {
        $model = new \App\Models\InvoiceStatus();

        $status = $model->select('name, slug')->findAll();

        return $this->response->setJSON(compact('status'));

    }
}
