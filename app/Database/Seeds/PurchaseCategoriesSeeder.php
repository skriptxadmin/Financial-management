<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PurchaseCategoriesSeeder extends Seeder
{
    public function run()
    {
         
        
        $data = [
            ['slug' => 'equipment', 'name' => 'Equipment'],
            ['slug' => 'consumables', 'name' => 'Consumables'],
            ['slug' => 'contingency', 'name' => 'Contingency'],
            ['slug' => 'travel', 'name' => 'Travel'],
            ['slug' => 'manpower', 'name' => 'Manpower'],
            ['slug' => 'overheads', 'name' => 'Overheads'],
            ['slug' => 'consultancy', 'name' => 'Consultancy'],
            ['slug' => 'miscellaneous', 'name' => 'Miscellaneous'],
            ['slug' => 'publication', 'name' => 'Publication'],
            ['slug' => 'licensing', 'name' => 'Licensing'],
            ['slug' => 'others', 'name' => 'Others'],
            ['slug' => 'professor_x', 'name' => 'Professor X'],
            ['slug' => 'professor_y_gift', 'name' => 'Professor Y Gift'],
            ['slug' => 'gift_institute', 'name' => 'Gift Institute'],
            ['slug' => 'gift_uni_xyz', 'name' => 'Gift Uni XYZ'],
        ];
    
        $model = new \App\Models\PurchaseCategory;
        foreach ($data as $item) {
            $model->insert($item);
        }
    }
}
