<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'slug'  => 'administrator',
                'name'  => 'Administrator'
            ],
             [
                'slug'  => 'manager',
                'name'  => 'Manager'
            ],
             [
                'slug'  => 'supervisor',
                'name'  => 'Supervisor'
            ],
        ];

        $model = new \App\Models\UserRole;
        foreach ($data as $item) {
            $model->insert($item);
        }
    }
}
