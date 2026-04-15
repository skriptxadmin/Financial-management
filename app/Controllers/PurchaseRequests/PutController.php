<?php

namespace App\Controllers\PurchaseRequests;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PutController extends BaseController
{
     public function index($slug)
    {
        $model = new \App\Models\PurchaseRequest;
        $purchaseRequest = $model->where('slug', $slug)->first();
        if(empty($purchaseRequest)){
            return view('404');
        }
        return view('purchase-requests/form/index', compact('slug'));
    }
}
