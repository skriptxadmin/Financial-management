<?php

namespace App\Controllers\PurchaseRequestStatus;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GetController extends BaseController
{
    public function index()
    {

        return view('purchase-request-status/list/index');
    }

    public function all()
    {
        $model = new \App\Models\PurchaseRequestStatus();

        $status = $model->select('name, slug')->findAll();

        return $this->response->setJSON(compact('status'));

    }
}
