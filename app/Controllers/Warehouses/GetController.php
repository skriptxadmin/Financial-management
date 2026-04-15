<?php
namespace App\Controllers\Warehouses;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class GetController extends BaseController
{
    use ResponseTrait;

    public function index()
    {

        return view('warehouses/list/index');
    }

    public function paginated()
    {
        $draw   = (int) $this->request->getGet('draw')??1;
        $start  = (int) $this->request->getGet('start');
        $length = (int) $this->request->getGet('length');
        
        $search = $this->request->getGet('search')['value'] ?? null;

        $page = ($start / $length) + 1;

        $warehouseModel = model(\App\Models\Warehouse::class);

        // Total records (no filter)
        $recordsTotal = $warehouseModel->countAll();

        $builder = $warehouseModel
    ->select('warehouses.slug, warehouses.name, 
              s.name as status,
              wl1.institute as location_primary,
              wl2.institute as location_secondary')
    ->join('warehouse_status s', 's.id = warehouses.status_id', 'left')
    ->join('warehouse_locations wl1', 'wl1.id = warehouses.location_primary_id', 'left')
    ->join('warehouse_locations wl2', 'wl2.id = warehouses.location_secondary_id', 'left');

        if (! empty($search)) {
            $builder->groupStart()
                ->like('name', $search)
                ->groupEnd();
        }

        // Filtered count
        $recordsFiltered = $builder->countAllResults(false);

        // Pagination
        $data = $builder
            ->limit($length, $start)
            ->get()
            ->getCustomResultObject(\App\Entities\Warehouse::class);

        

        return $this->response->setJSON([
            "draw"            => intval($draw),
            "recordsTotal"    => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data"            => $data,
        ]);
    }
    public function get($slug)
    {

        $model = new \App\Models\Warehouse;

        $warehouse = $model->select('slug, name, status_id, location_primary_id, location_secondary_id')
            ->where('slug', $slug)
            ->first();
        $warehouse->status = $warehouse->status_details;
        unset($warehouse->status_id);
        $warehouse->location_primary = $warehouse->primary_details;
        unset($warehouse->location_primary_id);
        $warehouse->location_secondary = $warehouse->secondary_details;
        unset($warehouse->location_secondary_id);

        return $this->response->setJSON(compact('warehouse'));
    }
}