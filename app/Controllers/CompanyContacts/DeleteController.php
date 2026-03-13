<?php

namespace App\Controllers\CompanyContacts;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DeleteController extends BaseController
{
      public function index($slug)
    {
        $model = new \App\Models\CompanyContact;

        $user = session()->get('user');

        $model->where('slug', $slug)->set('deleted_by', $user->id)->update();

        $model->where('slug', $slug)->delete();

        return $this->response->setJSON(['success' => true]);
    }
}
