<?php
namespace App\Controllers\Users;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use Carbon\Carbon;

class ToggleController extends BaseController
{
    use ResponseTrait;

    public function block($username)
    {

        $model = new \App\Models\User;

        $user = $model->select('blocked_at')->where('username', $username)->first();

        $now = Carbon::now();

        $blocked_at = empty($user->blocked_at)?$now:NULL;


            $model->where('username', $username)
            ->set('blocked_at', $blocked_at)->update();

        
            $success = true;
            
        return $this->respond(compact('success'));
    }

    public function visible($username)
    {

        $model = new \App\Models\User;

        $user = $model->select('visible')->where('username', $username)->first();

        $visible = $user->visible==1?0:1;


            $model->where('username', $username)
            ->set('visible', $visible)->update();

        
            $success = true;
            
        return $this->respond(compact('success'));
    }

   
}
