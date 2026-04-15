<?php

namespace App\Controllers\PurchaseRequests;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GetController extends BaseController
{
    public function index()
    {
        return view('purchase-requests/list/index');
    }

     public function paginated()
    {
        $draw   = (int) $this->request->getGet('draw');
        $start  = (int) $this->request->getGet('start');
        $length = (int) $this->request->getGet('length');
        
        if(!$length) $length = 10;
        if(!$start) $start = 0;
        if(!$draw) $draw = 1;

        $search = $this->request->getGet('search')['value'] ?? null;

        $page = ($start / $length) + 1;

        $model = model(\App\Models\PurchaseRequest::class);

        // Total records (no filter)
        $recordsTotal = $model->countAll();

        $builder = $model
            ->select('title, request_id, company_id, company_contact_id, discount, tax, total, payable, status_id');

        if (! empty($search)) {
            $builder->groupStart()
                ->like('title', $search)
                ->like('request_id', $search)
                ->groupEnd();
        }

        // Filtered count
        $recordsFiltered = $builder->countAllResults(false);

        // Pagination
        $data = $builder
            ->limit($length, $start)
            ->get()
            ->getCustomResultObject(\App\Entities\PurchaseRequest::class);

              foreach($data as &$purchase_request){

        $purchase_request->company = $purchase_request->company_details;
        unset($purchase_request->company_id);
        $purchase_request->company_contact = $purchase_request->contact_details;
        unset($purchase_request->company_contact_id);
           $purchase_request->status = $purchase_request->status_details;
        unset($purchase_request->status_id);
            }



        return $this->response->setJSON([
            "draw"            => intval($draw),
            "recordsTotal"    => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data"            => $data ? array_values($data) : [],
        ]);
    }


}
