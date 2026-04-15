<?php
namespace App\Controllers\WarehouseLocations;

use App\Controllers\BaseController;

class PostController extends BaseController
{
    public function index()
    {
        $slug = '';
        return view('warehouse-locations/form/index', compact('slug'));
    }

    public function save()
    {
        // Define validation rules
        $rules = [
           
            'institute'  => [
                'rules'  => 'required|alpha_space|min_length[2]|max_length[50]',
                'errors' => [
                    'required'    => 'Institute is required',
                    'alpha_space' => 'Institute can only contain letters and spaces',
                    'min_length'  => 'Institute must be at least 2 characters',
                    'max_length'  => 'Institute cannot exceed 50 characters',
                ],
            ],
            'department'  => [
                'rules'  => 'required|alpha_space|min_length[2]|max_length[50]',
                'errors' => [
                    'required'    => 'Department is required',
                    'alpha_space' => 'Department can only contain letters and spaces',
                    'min_length'  => 'Department must be at least 2 characters',
                    'max_length'  => 'Department cannot exceed 50 characters',
                ],
            ],
            
            'building_name'     => [
                'rules'  => 'required|regex_match[/^[A-Za-z\s0-9_]+$/]|min_length[2]|max_length[50]',
                'errors' => [
                    'required'    => 'Building name is required',
                    'min_length'  => 'Building name must be at least 2 characters',
                    'max_length'  => 'Building name cannot exceed 50 characters',
                ],
            ],
            'phone_number'  => [
                'rules'  => 'required|numeric|min_length[10]|max_length[10]|is_unique[warehouse_locations.phone_number]',
                'errors' => [
                    'required'   => 'phone_number is required',
                    'numeric'    => 'phone_number must contain only digits',
                    'min_length' => 'phone_number must be at least 10 digits',
                    'max_length' => 'phone_number cannot exceed 10 digits',
                ],
            ],
            'floor_number'    => [
                'rules'  => 'required|numeric|min_length[1]|max_length[5]|',
                'errors' => [
                    'required'   => 'floor_number is required',
                    'numeric'    => 'floor_number must contain only digits',
                    'min_length' => 'floor_number must be at least 1 digits',
                    'max_length' => 'floor_number cannot exceed 5 digits',
                ],
            ],
            'lab_number'      => [
                'rules'  => 'required|numeric|min_length[1]|max_length[5]|',
                'errors' => [
                    'required'   => 'lab_number is required',
                    'numeric'    => 'lab_number must contain only digits',
                    'min_length' => 'lab_number must be at least 1 digits',
                    'max_length' => 'lab_number cannot exceed 5 digits',
                ],
            ],
            'note'    => [
                'rules'  => 'required|alpha_space|min_length[2]|max_length[500]',
                'errors' => [
                    'required'    => 'Note is required',
                    'alpha_space' => 'Note can only contain letters and spaces',
                    'min_length'  => 'Note must be at least 2 characters',
                    'max_length'  => 'Note cannot exceed 50 characters',
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

        helper('slug');
        
        $model = new \App\Models\WarehouseLocation();

        $validatedData['slug'] = generateUniqueSlug($validatedData['institute'],$model);

        $model->save($validatedData);

        return $this->response
            ->setJSON(['success' => true, 'redirect'=>base_url('warehouse-locations')]);
    
    }
}
