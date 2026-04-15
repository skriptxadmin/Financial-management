<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class WarehouseLocationsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [   'slug' => 'main-warehouse',
                'institute'  => 'Institute of Science and Technology for Advanced Studies and Research',
                'department'     => 'Department of Computer Science and Engineering',
                'building_name'    => 'Building A',
                'phone_number'  => '95800385501',
                'floor_number' => '1',
                'lab_number'  => '201',
                'note'   => 'Main warehouse location',
            
            ],
            [   'slug' => 'warehouse',
                'institute'  => 'Takshashila University',
                'department'     => 'Department of Computer Application',
                'building_name'    => 'Building B',
                'phone_number'  => '9562451384',
                'floor_number' => '5',
                'lab_number'  => '203',
                'note'   => 'Warehouse location',
            
            ],
        ];

        $model = new \App\Models\WarehouseLocation;
        foreach ($data as $item) {
            $model->insert($item);
        }
    }
}
