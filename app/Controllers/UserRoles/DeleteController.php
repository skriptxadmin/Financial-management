<?php
namespace App\Controllers\UserRoles;

use App\Controllers\BaseController;

class DeleteController extends BaseController
{
    public function index($slug)
    {
        $model = new \App\Models\UserRole;

        $user = session()->get('user');

        $model->where('slug', $slug)->set('deleted_by', $user->id)->update();

        $model->where('slug', $slug)->delete();

        return $this->response->setJSON(['success' => true]);
    }
}
