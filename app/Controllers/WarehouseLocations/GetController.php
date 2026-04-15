<?php
namespace App\Controllers\WarehouseLocations;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class GetController extends BaseController
{
    use ResponseTrait;

    public function index()
    {

        return view('warehouse-locations/list/index');
    }

    public function paginated()
    {
        $draw   = (int) $this->request->getGet('draw');
        $start  = (int) $this->request->getGet('start');
        $length = (int) $this->request->getGet('length');
        if ($length <= 0) {
            $length = 10; // Default length
        }

        $search = $this->request->getGet('search')['value'] ?? null;

        $page = ($start / $length) + 1;

        $model = model(\App\Models\WarehouseLocation::class);

        // Total records (no filter)
        $recordsTotal = $model->countAll();

        $builder = $model
            ->select('slug, institute, department, building_name, phone_number,floor_number, lab_number, note, visible');

        if (! empty($search)) {
            $builder->groupStart()
                ->like('slug', $search)
                ->orLike('institute', $search)
                ->orLike('department', $search)
                ->orLike('building_name', $search)
                ->orLike('phone_number', $search)
                ->orLike('floor_number', $search)
                ->orLike('lab_number', $search)
                ->orLike('note', $search)
                ->groupEnd();
        }

        // Filtered count
        $recordsFiltered = $builder->countAllResults(false);

        // Pagination
        $data = $builder
            ->limit($length, $start)
            ->get()
            ->getResultArray();

        return $this->response->setJSON([
            "draw"            => intval($draw),
            "recordsTotal"    => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data"            => $data,
        ]);
    }

   
    public function get($slug)
    {

        $model = new \App\Models\WarehouseLocation();

        $location =$model->select('institute,department,building_name,phone_number,floor_number,lab_number,note ,slug')
            ->where('slug', $slug)
            ->first();

        return $this->response->setJSON(compact('location'));
    }
}
