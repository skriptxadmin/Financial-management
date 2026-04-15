<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class WarehousesSeeder extends Seeder 
{
    public function run()
    {
         $data = [
            [
                'slug'  => 'muscel-blaze',
                'name'  => 'Muscel Blaze',
                'status_id' => 1,
                'location_primary_id' => 1,
                'location_secondary_id' => 2,  
            ],
            [
                'slug' => 'gokul-hub',
                'name' => 'Gokul Hub',
                'status_id' => 2,
                'location_primary_id' => 2,
                'location_secondary_id' => 1,
            ]
             
        ];

        $model = new \App\Models\Warehouse;
        foreach ($data as $item) {
            $model->insert($item);
        }
    }
}
