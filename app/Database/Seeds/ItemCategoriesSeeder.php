<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ItemCategoriesSeeder extends Seeder 
{
    public function run()
    {
         $data = [
            [
                'slug'  => 'stationary',
                'name'  => 'Stationary'
            ],
             [
                'slug'  => 'computer',
                'name'  => 'Computer'
            ],
            [
                'slug'  => 'vacuum',
                'name'  => 'Vacuum'
            ],
             [
                'slug'  => 'mechanical',
                'name'  => 'Mechanical'
            ],
        ];

        $model = new \App\Models\ItemCategory;
        foreach ($data as $item) {
            $model->insert($item);
        }
    }
}
