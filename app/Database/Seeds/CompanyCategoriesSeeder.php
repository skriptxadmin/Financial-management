<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CompanyCategoriesSeeder extends Seeder
{
    public function run()
    {
         $data = [
            [
                'slug'  => 'electronics',
                'name'  => 'Electronics'
            ],
             [
                'slug'  => 'computer',
                'name'  => 'Computer'
            ],
             [
                'slug'  => 'mechanical',
                'name'  => 'Mechanical'
            ],
        ];

        $model = new \App\Models\CompanyCategory;
        foreach ($data as $item) {
            $model->insert($item);
        }
    }
}
