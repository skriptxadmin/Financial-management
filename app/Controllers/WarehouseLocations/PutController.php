<?php
namespace App\Controllers\WarehouseLocations;

use App\Controllers\BaseController;

class PutController extends BaseController
{
    public function index($slug)
    {

        return view('warehouse-locations/form/index', compact('slug'));

    }

    public function save($slug)
    {
                                    // Define validation rules
        $slugParam = $slug; // slug from URL or function parameter

        $rules = [
            'institute' => [
                'rules' => 'required|alpha_space|min_length[2]|max_length[50]',
            ],

            'department'  => [
                'rules' => 'required|alpha_space|min_length[2]|max_length[50]',
            ],

           
            'building_name'     => [
                'rules'  => 'required|regex_match[/^[A-Za-z\s0-9_]+$/]|min_length[2]|max_length[50]',
                
                ],

            'phone_number' => [
                'rules' => "required|numeric|exact_length[10]|is_unique[warehouse_locations.phone_number,slug,{$slugParam}]",
                'errors' => [
                    'is_unique' => 'Phone number already exists',
                ],
            ],

            'floor_number' => [
                'rules' => "required|numeric|min_length[1]|max_length[5]",
            ],

            'lab_number' => [
                'rules' => "required|numeric|min_length[1]|max_length[5]",
            ],

            'note' => [
                'rules' => "required|alpha_space|min_length[2]|max_length[500]",
            ],
        ];
        // Validate input
        if (! $this->validate($rules)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['errors' => $this->validator->getErrors()]);
        }

        $validatedData = $this->validator->getValidated();



        $model = new \App\Models\WarehouseLocation();

        $model->where('slug', $slugParam)
            ->set($validatedData)
            ->update();
         return $this->response
            ->setJSON(['success' => true, 'redirect'=>base_url('warehouse-locations')]);

    }
}
