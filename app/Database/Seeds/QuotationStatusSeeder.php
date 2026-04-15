<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class QuotationStatusSeeder extends Seeder
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

        $model = new \App\Models\QuotationStatus;
        foreach ($data as $item) {
            $model->insert($item);
        }
    }
}
