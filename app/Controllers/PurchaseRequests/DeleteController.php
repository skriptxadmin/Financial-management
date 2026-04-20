<?php

namespace App\Controllers\PurchaseRequests;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DeleteController extends BaseController
{
    public function index($slug)
    {
            $model = new \App\Models\PurchaseRequest;
            $user = session()->get('user');

            $purchaseRequest = $model->where('slug', $slug)->first();

            if ($purchaseRequest) {
                $itemModel = new \App\Models\PurchaseRequestItem;

                // Soft delete related items
                $itemModel->where('purchase_request_id', $purchaseRequest->id)
                        ->set('deleted_by', $user->id)
                        ->update();
                $itemModel->where('purchase_request_id', $purchaseRequest->id)->delete();

                // Soft delete purchase request
                $model->where('id', $purchaseRequest->id)
                    ->set('deleted_by', $user->id)
                    ->update();
                $model->delete($purchaseRequest->id);
            }

            return $this->response->setJSON(['success' => true]);
    }
}
