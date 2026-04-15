<?php

namespace App\Controllers\UrgencyLevels;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GetController extends BaseController
{
     public function index()
    {

        return view('urgency-levels/list/index');
    }

    public function all()
    {
        $model = new \App\Models\UrgencyLevel();

        $urgencyLevels = $model->select('name, slug')->findAll();

        return $this->response->setJSON(compact('urgencyLevels'));

    }
}
