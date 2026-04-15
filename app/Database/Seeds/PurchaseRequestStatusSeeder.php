<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PurchaseRequestStatusSeeder extends Seeder
{
     public function run()
    {
         $data = [
            [
                'slug'  => 'created',
                'name'  => 'Created'
            ],
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

        $model = new \App\Models\PurchaseRequestStatus;
        foreach ($data as $item) {
            $model->insert($item);
        }
    }
}
