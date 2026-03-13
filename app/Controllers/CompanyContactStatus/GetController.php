<?php

namespace App\Controllers\CompanyContactStatus;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GetController extends BaseController
{
     public function index()
    {

        return view('company-contact-status/list/index');
    }

    public function all()
    {
        $model = new \App\Models\CompanyContactStatus();

        $status = $model->select('name, slug')->findAll();

        return $this->response->setJSON(compact('status'));

    }
}
