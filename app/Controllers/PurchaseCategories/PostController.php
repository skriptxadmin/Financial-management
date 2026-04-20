<?php

namespace App\Controllers\PurchaseCategories;

use App\Controllers\BaseController;

class PostController extends BaseController
{
    public function save()
    {
        $rules = [
            'name' => [
                'rules'  => [
                    'required',
                    'alpha_space',
                    'min_length[2]',
                    'max_length[50]',
                    static function ($value, $data, &$error) {
                        $model = new \App\Models\PurchaseCategory();
                        if ($model->where('name', $value)->first()) {
                            $error = 'Category name already exists';
                            return false;
                        }
                        return true;
                    }
                ],
                'errors' => [
                    'required'    => 'Name is required',
                    'alpha_space' => 'Name can only contain letters and spaces',
                    'min_length'  => 'Name must be at least 2 characters',
                    'max_length'  => 'Name cannot exceed 50 characters',
                ],
            ],
            'head_user_id' => [
                'rules'  => 'permit_empty|is_not_unique[users.id]',
                'errors' => [
                    'is_not_unique' => 'Invalid head user selected',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['errors' => $this->validator->getErrors()]);
        }

        $validatedData = $this->validator->getValidated();

        helper('slug');
        $model = new \App\Models\PurchaseCategory();
        $validatedData['slug'] = generateUniqueSlug($validatedData['name'], $model);

        $model->save($validatedData);

        return $this->response->setJSON(['success' => true]);
    }
}
