<?php
namespace App\Controllers\UserRoles;

use App\Controllers\BaseController;

class GetController extends BaseController
{
    public function index()
    {

        return view('user-roles/list/index');
    }

    public function all()
    {
        $model = new \App\Models\UserRole();

        $roles = $model->select('name, slug')->findAll();

        return $this->response->setJSON(compact('roles'));

    }
}
