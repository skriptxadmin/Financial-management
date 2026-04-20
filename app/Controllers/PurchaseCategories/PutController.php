<?php

namespace App\Controllers\PurchaseCategories;

use App\Controllers\BaseController;

class PutController extends BaseController
{
    public function save($slug)
    {
        $rules = [
            'name' => [
                'rules'  => [
                    'required',
                    'alpha_space',
                    'min_length[2]',
                    'max_length[50]',
                    static function ($value, $data, &$error) use ($slug) {
                        $model = new \App\Models\PurchaseCategory();
                        if ($model->where('name', $value)->where('slug !=', $slug)->first()) {
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

        $model = new \App\Models\PurchaseCategory();
        $model->where('slug', $slug)->set($validatedData)->update();

        return $this->response->setJSON(['success' => true]);
    }
}
