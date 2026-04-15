<?php

namespace App\Controllers\QuotationStatus;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GetController extends BaseController
{
     public function index()
    {

        return view('quotation-status/list/index');
    }

    public function all()
    {
        $model = new \App\Models\QuotationStatus();

        $status = $model->select('name, slug')->findAll();

        return $this->response->setJSON(compact('status'));

    }
}
