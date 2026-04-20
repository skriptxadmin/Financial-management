<?php

namespace App\Controllers\PurchaseCategories;

use App\Controllers\BaseController;

class GetController extends BaseController
{
    public function index()
    {
        return view('purchase-categories/list/index');
    }

    public function all()
    {
        $search = $this->request->getGet('search')['value'] ?? null;
        $model = new \App\Models\PurchaseCategory();

        $builder = $model->select("purchase_categories.name, purchase_categories.slug, purchase_categories.head_user_id, CONCAT(users.firstname, ' ', users.lastname) as head_name")
            ->join('users', 'users.id = purchase_categories.head_user_id', 'left');

        if (!empty($search)) {
            $builder->like('purchase_categories.name', $search);
        }

        $categories = $builder->findAll();

        return $this->response->setJSON(compact('categories'));
    }

    public function get($slug)
    {
        $model = new \App\Models\PurchaseCategory();
        $category = $model->select("purchase_categories.*, CONCAT(users.firstname, ' ', users.lastname) as head_name")
            ->join('users', 'users.id = purchase_categories.head_user_id', 'left')
            ->where('purchase_categories.slug', $slug)
            ->first();

        if (!$category) {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Category not found']);
        }

        return $this->response->setJSON(compact('category'));
    }
}
