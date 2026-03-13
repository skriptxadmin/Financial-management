<?php

namespace App\Controllers\CompanyCategories;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PostController extends BaseController
{
 

    public function save()
    {
        $rules = [
            'name' => [
                'rules'  => 'required|alpha_space|min_length[2]|max_length[50]|is_unique[company_categories.name]',
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

        helper('slug');

        $model= new \App\Models\CompanyCategory;

        $validatedData['slug'] = generateUniqueSlug($validatedData['name'], $model);


        $model->save($validatedData);

        return $this->response
            ->setJSON(['success'=> true]);
    }

}
