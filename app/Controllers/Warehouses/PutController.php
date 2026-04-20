<?php
namespace App\Controllers\Warehouses;

use App\Controllers\BaseController;

class PutController extends BaseController
{
    public function index($slug)
    {

        return view('warehouses/form/index', compact('slug'));

    }

    public function save($slug)
    {
                                    // Define validation rules
        $warehouseParam = $slug; // itemname from URL or function parameter
   
        $rules = [
             'name' => [
                'rules'  => 'required|alpha_space|min_length[2]|max_length[100]',
                'errors' => [
                    'required'    => 'Item name is required',
                    'alpha_space' => 'Item name can only contain letters and spaces',
                    'min_length'  => 'Item name must be at least 2 characters',
                    'max_length'  => 'Item name cannot exceed 100 characters',
                ],
            ],
            'status' => [
                'rules'  => 'required|is_not_unique[warehouse_status.slug]',
                'errors' => [
                    'required' => 'Status is required',
                ],
            ],
            'location_primary'      => [
                'rules'  => 'required|is_not_unique[warehouse_locations.slug]',
                'errors' => [
                    'required'   => 'Primary location is required',
                ],
            ],
            'location_secondary'  => [
                'rules'  => 'required|is_not_unique[warehouse_locations.slug]',
                'errors' => [
                    'required'      => 'Secondary location is required',
                ],
            ],
        ];
        // Validate input
        if (! $this->validate($rules)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['errors' => $this->validator->getErrors()]);
        }

        $validatedData = $this->validator->getValidated();

 $statusModel = new \App\Models\WarehouseStatus;
        
        $status = $statusModel
            ->where('slug', $validatedData['status'])
            ->select('id')
            ->first();
        $validatedData['status_id'] = $status->id; // $validatedData['status']

        $locationModel = new \App\Models\WarehouseLocation;
        
        $primary = $locationModel
            ->where('slug', $validatedData['location_primary'])
            ->select('id')
            ->first();

        $validatedData['location_primary_id'] = $primary->id;

        $secondary = $locationModel
            ->where('slug', $validatedData['location_secondary'])
            ->select('id')
            ->first();
        $validatedData['location_secondary_id'] = $secondary->id;


        unset($validatedData['status']);
        unset($validatedData['location_primary']);
        unset($validatedData['location_secondary']);

        $warehouseModel = new \App\Models\Warehouse;

        try {
             $warehouseModel->where('slug', $warehouseParam)
              ->set($validatedData)
              ->update();
            return $this->response->setJSON(['success' => true, 'redirect' => base_url('warehouses')]);

        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['message' => $e->getMessage()]);
        }

    }
}
