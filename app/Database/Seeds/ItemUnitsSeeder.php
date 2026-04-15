<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ItemUnitsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'slug'=>'kg',
                'name'=>'Kilogram' 
            ],
            [
                'slug'=>'gram',
                'name'=>'Gram'
            ],
            [
                'slug'=>'meter',
                'name'=>'Meter',  
            ],
            [
                'slug'=>'box',
                'name'=>'Box',
            ],
        ];

        $model = new \App\Models\ItemUnit;
        foreach ($data as $item) {
            $model->insert($item);
        }
    }
}
