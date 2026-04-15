<?php

namespace App\Controllers\UrgencyLevels;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PutController extends BaseController
{
     public function save($slug)
    {
        $rules = [
            'name'   => [
                'rules' => "required|alpha_space|min_length[2]|max_length[50]|is_unique[urgency_levels.name,slug,{$slug}]",
                'errors' => [
                    'required'    => 'Name is required',
                    'alpha_space' => 'Name can only contain letters and spaces',
                    'min_length'  => 'Name must be at least 2 characters',
                    'max_length'  => 'Name cannot exceed 50 characters',
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

        $model = new \App\Models\UrgencyLevel;

        $model->where('slug', $slug)
            ->set($validatedData)
            ->update();
        return $this->response
            ->setJSON(['success' => true]);
    }
}
