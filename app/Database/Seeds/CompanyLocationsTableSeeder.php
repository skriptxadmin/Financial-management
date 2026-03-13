<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CompanyLocationsTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'state'  => 'Tamilnadu',
                'city'  => 'Tindivanam',
                'country' => 'India'
            ],
        ];

        $model = new \App\Models\CompanyLocation;
        foreach ($data as $item) {
            $model->insert($item);
        }
    }
}
