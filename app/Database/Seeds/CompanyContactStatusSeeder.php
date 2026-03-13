<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CompanyContactStatusSeeder extends Seeder
{
    public function run()
    {
          $data = [
            [
                'slug'  => 'pending',
                'name'  => 'Pending'
            ],
             [
                'slug'  => 'approved',
                'name'  => 'Approved'
            ],
             [
                'slug'  => 'rejected',
                'name'  => 'Rejected'
            ],
        ];

        $model = new \App\Models\CompanyContactStatus;
        foreach ($data as $item) {
            $model->insert($item);
        }
    }
}
