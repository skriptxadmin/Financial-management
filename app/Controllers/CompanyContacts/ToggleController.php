<?php
namespace App\Controllers\CompanyContacts;

use App\Controllers\BaseController;
use Carbon\Carbon;
use CodeIgniter\API\ResponseTrait;

class ToggleController extends BaseController
{
    use ResponseTrait;

    public function status($slug)
    {

        $model = new \App\Models\CompanyContact;

        $now = Carbon::now();

        $data = $this->request->getRawInput();

        $statusSlug = $data['status'] ?? null;

        $statusModel = new \App\Models\CompanyContactStatus;

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

    public function visible($slug)
    {

        $model = new \App\Models\CompanyContact;

        $row = $model->select('visible')->where('slug', $slug)->first();

        $visible = $row->visible == 1 ? 0 : 1;

        $model->where('slug', $slug)
            ->set('visible', $visible)->update();

        $success = true;

        return $this->respond(compact('success'));
    }

      public function working($slug)
    {

        $model = new \App\Models\CompanyContact;

        $row = $model->select('working')->where('slug', $slug)->first();

        $working = $row->working == 1 ? 0 : 1;

        $model->where('slug', $slug)
            ->set('working', $working)->update();

        $success = true;

        return $this->respond(compact('success'));
    }


}
