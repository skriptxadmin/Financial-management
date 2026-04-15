<?php
namespace App\Controllers\WarehouseLocations;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use Carbon\Carbon;

class ToggleController extends BaseController
{
    use ResponseTrait;


    public function visible($slug)
    {

        $model = new \App\Models\WarehouseLocation;

        $user = $model->select('visible')->where('slug', $slug)->first();

        $visible = $user->visible==1?0:1;


            $model->where('slug', $slug)
            ->set('visible', $visible)->update();

        
            $success = true;
            
        return $this->respond(compact('success'));
    }

   
}
