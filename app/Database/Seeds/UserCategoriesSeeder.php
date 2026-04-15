<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserCategoriesSeeder extends Seeder
{
    public function run()
    {
         $data = [
            [
                'slug'  => 'clark',
                'name'  => 'Clark'
            ],
             [
                'slug'  => 'admin',
                'name'  => 'Admin'
            ],
             [
                'slug'  => 'operator',
                'name'  => 'Operator'
            ],
        ];

        $model = new \App\Models\UserCategory;
        foreach ($data as $item) {
            $model->insert($item);
        }
    }
}
