<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PurchaseRequestStatusSeeder extends Seeder
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
            [
                'slug'  => 'edited',
                'name'  => 'Edited'
            ],
        ];

        $model = new \App\Models\PurchaseRequestStatus;
        $model->truncate();
        foreach ($data as $item) {
            $model->insert($item);
        }
    }
}
