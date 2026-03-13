<?php
namespace App\Controllers\Users;

use App\Controllers\BaseController;

class DeleteController extends BaseController
{
    public function index($username)
    {
        $model = new \App\Models\User;
        
        $user = session()->get('user');

        $model->where('username', $username)->set('deleted_by', $user->id)->update();

        $model->where('username', $username)->delete();

        return $this->response->setJSON(['success' => true]);
    }
}
