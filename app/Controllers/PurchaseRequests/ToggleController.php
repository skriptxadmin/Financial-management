<?php
namespace App\Controllers\PurchaseRequests;

use App\Controllers\BaseController;
use Carbon\Carbon;
use CodeIgniter\API\ResponseTrait;

class ToggleController extends BaseController
{
    use ResponseTrait;

    public function status($slug)
    {
        $model = new \App\Models\PurchaseRequest;
        $purchaseRequest = $model->where('slug', $slug)->first();

        if (empty($purchaseRequest)) {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Not found']);
        }

        $categoryModel = new \App\Models\PurchaseCategory;
        $category = $categoryModel->find($purchaseRequest->category_id);
        $user = session()->get('user');

        if (empty($category) || (int)$category->head_user_id !== (int)$user->id) {
            return $this->response
                ->setStatusCode(403)
                ->setJSON(['errors' => ['Only category head can change status']]);
        }

        $now = Carbon::now();

        $data = $this->request->getRawInput();

        $statusSlug = $data['status'] ?? null;

        $statusModel = new \App\Models\PurchaseRequestStatus;

        $status = $statusModel->where('slug', $statusSlug)->first();

        if (empty($status->id)) {

            return $this->response
                ->setStatusCode(422)
                ->setJSON(['errors' => ['Invalid Status']]);
        }

        $approved_at= NULL;
        $rejected_at = NULL;
        $approved_by = NULL;
        $rejected_by = NULL;
        $now = Carbon::now();
        $user = session()->get('user');

        if($statusSlug == 'approved'){
            $approved_at = $now;
            $approved_by = $user->id;
        }

        if($statusSlug == 'rejected'){
            $rejected_at = $now;
            $rejected_by = $user->id;
        }

        $data = [
            'status_id' => $status->id,
            'approved_at' => $approved_at,
            'rejected_at' => $rejected_at,
            'approved_by' => $approved_by,
            'rejected_by' => $rejected_by
        ];

        $model->where('slug', $slug)
            ->set($data)->update();

        $success = $data;

        return $this->respond(compact('success'));
    }
}