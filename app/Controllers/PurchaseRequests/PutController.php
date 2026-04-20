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



    public function save($slug)
{

    $rules = [
    'title'          => 'required|min_length[2]',
    'company'        => 'required',
    'companyContact' => 'required',
    'category'       => 'required',
    'discount'       => 'required|decimal',
    'tax'            => 'required|decimal',
    'notes'          => 'required|min_length[5]',
    'items'          => 'required'
    ];

    if (!$this->validate($rules)) {
        return $this->response->setStatusCode(422)->setJSON([
            'errors' => $this->validator->getErrors()
        ]);
    }
    $model = new \App\Models\PurchaseRequest;
    $purchaseRequest = $model->where('slug', $slug)->first();

    if (empty($purchaseRequest)) {
        return $this->response->setStatusCode(404)->setJSON(['message' => 'Not found']);
    }

    $data = $this->request->getJSON(true);

    // Map Select2 slugs back to IDs
    $company = (new \App\Models\Company)->where('slug', $data['company'])->first();
    $contact = (new \App\Models\CompanyContact)->where('slug', $data['companyContact'])->first();
    $category = (new \App\Models\PurchaseCategory)->where('slug', $data['category'])->first();
    $status = (new \App\Models\PurchaseRequestStatus)->where('slug', 'edited')->first();

    $user = session()->get('user');

    $updateData = [
        'title'              => $data['title'],
        'company_id'         => $company->id,
        'company_contact_id' => $contact->id,
        'category_id'        => $category->id,
        'discount'           => $data['discount'],
        'tax'                => $data['tax'],
        'total'              => $data['total'],
        'payable'            => $data['payable'],
        'notes'              => $data['notes'],
        'status_id'          => $status->id ?? 1,
        'edited_at'          => date('Y-m-d H:i:s'),
        'edited_by'          => $user->id ?? null
    ];

    $model->update($purchaseRequest->id, $updateData);

    // Sync Items: Remove old and insert new
    $itemModel = (new \App\Models\PurchaseRequestItem);
    $itemModel->where('purchase_request_id', $purchaseRequest->id)->delete();

    $items = [];
    $itemsTable = (new \App\Models\Item);
    foreach ($data['items'] as $item) {
        $actualItem = $itemsTable->where('slug', $item['item'])->first();
        $items[] = [
            'purchase_request_id' => $purchaseRequest->id,
            'item_id'             => $actualItem->id,
            'quantity'            => $item['quantity'],
            'price'               => $item['price'],
            'tax'                 => $item['tax'],
            'tax_amount'          => $item['tax_amount'],
            'subtotal'            => $item['subtotal'],
            'total'               => $item['total'],
        ];
    }
    $itemModel->insertBatch($items);

    return $this->response->setJSON([
        'success' => true,
        'redirect' => base_url('purchase-requests')
    ]);
}
}
