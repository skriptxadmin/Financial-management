<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UrgencylevelsSeeder extends Seeder
{
    public function run()
    {
         $data = [
            [
                'slug'  => 'wish',
                'name'  => 'Wish'
            ],
             [
                'slug'  => 'trivial',
                'name'  => 'Trivial'
            ],
             [
                'slug'  => 'low',
                'name'  => 'Low'
            ],
                [
                'slug'  => 'medium',
                'name'  => 'Medium'
            ],
          
            
             [
                'slug'  => 'high',
                'name'  => 'High'
            ],
             [
                'slug'  => 'critical',
                'name'  => 'Critical'
            ],
        ];

        $model = new \App\Models\UrgencyLevel;
        foreach ($data as $item) {
            $model->insert($item);
        }
    }
}
