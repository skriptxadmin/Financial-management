<?php
namespace App\Controllers\Items;

use App\Controllers\BaseController;

class PostController extends BaseController
{
    public function index()
    {
        $slug = '';
        return view('items/form/index', compact('slug'));
    }

    public function save()
    {
        // Define validation rules
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
            'nickname' => [
                'rules'  => 'permit_empty|alpha_space|min_length[2]|max_length[100]',
                'errors' => [
                    'alpha_space' => 'Nickname can only contain letters and spaces',
                    'min_length'  => 'Nickname must be at least 2 characters',
                    'max_length'  => 'Nickname cannot exceed 100 characters',
                ],
            ],
            'partno'    => [
                'rules'  => 'permit_empty|min_length[2]|max_length[100]',
                'errors' => [
                    'min_length'         => 'Part number must be at least 2 characters',
                    'max_length'         => 'Part number cannot exceed 100 characters',
                ],
            ],
            'link'      => [
                'rules'  => 'permit_empty|max_length[255]',
                'errors' => [
                    'valid_url' => 'Link must be a valid URL',
                    'max_length' => 'Link cannot exceed 255 characters',
                ],
            ],
            'datasheet'  => [
                'rules'  => 'permit_empty|max_length[255]',
                'errors' => [
                    'valid_url' => 'Data sheet must be a valid URL',
                    'max_length' => 'Data sheet cannot exceed 255 characters',
                ],
            ],
            'unit'      => [
                'rules'  => 'required|is_not_unique[item_units.slug]',
                'errors' => [
                    'required'   => 'Unit is required',
                ],
            ],
            'category'  => [
                'rules'  => 'required|is_not_unique[item_categories.slug]',
                'errors' => [
                    'required'      => 'Category is required',
                ],
            ],
            'specification'  => [
                'rules'  => 'permit_empty|min_length[2]|max_length[255]',
                'errors' => [
                    
                    'min_length'  => 'Specification must be at least 2 characters',
                    'max_length'  => 'Specification cannot exceed 255 characters',
                ],
            ],
            'handlinginstruction'  => [
                'rules'  => 'permit_empty|min_length[2]|max_length[255]',
                'errors' => [
                    'min_length'  => 'Handling instruction must be at least 2 characters',
                    'max_length'  => 'Handling instruction cannot exceed 255 characters',
                ],
            ],
            'tags'  => [
                 'rules' => 'required|min_length[2]|max_length[255]',
                'errors' => [
                    'min_length'         => 'Tags must be at least 2 characters',
                    'max_length'         => 'Tags cannot exceed 255 characters',
                ],
            ],
            'description'  => [
                'rules'  => 'permit_empty|min_length[2]|max_length[255]',
                'errors' => [
                    'min_length'  => 'Description must be at least 2 characters',
                    'max_length'  => 'Description cannot exceed 255 characters',
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

        $unitModel = new \App\Models\ItemUnit;
        
        $unit = $unitModel
            ->where('slug', $validatedData['unit'])
            ->select('id')
            ->first();
        $validatedData['unit_id'] = $unit->id;

        $categoryModel = new \App\Models\ItemCategory;
        
        $category = $categoryModel
            ->where('slug', $validatedData['category'])
            ->select('id')
            ->first();

        $validatedData['category_id'] = $category->id;

        unset($validatedData['unit']);
        unset($validatedData['category']);


        helper('slug');

        $itemModel = new \App\Models\Item;

        $validatedData['slug'] = generateUniqueSlug($validatedData['name'], $itemModel);

        

        try {
            $itemModel->save($validatedData);
            return $this->response->setJSON(['success' => true, 'redirect' => base_url('items')]);

        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['message' => $e->getMessage()]);
        }
    }
}