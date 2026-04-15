<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ItemsSeeder extends Seeder 
{
    public function run()
    {
         $data = [
            [
                'slug'  => 'pencil',
                'name'  => 'Pencil',
                'nickname' => 'Pen',
                'partno' => 'ST-001',
                'link' => 'https://example.com/stationary',
                'datasheet' => 'https://example.com/stationary/datasheet',
                'specification' => 'High-quality stationary items for office use.',
                'handlinginstruction' => 'Store in a cool, dry place.',
                'unit_id'   => 1,
                'category_id' => 1,
                'tags' => 'stationary,office,supplies',
                'description' => 'A simple pencil for writing.'
            ],
             [
                'slug'  => 'camera',
                'name'  => 'Camera',
                'nickname' => 'Cam',
                'partno' => 'CP-001',
                'link' => 'https://example.com/computer',
                'datasheet' => 'https://example.com/computer/datasheet',
                'specification' => 'High-performance computer for professional use.',
                'handlinginstruction' => 'Handle with care. Avoid exposure to moisture.',
                'unit_id' => 2,
                'category_id' => 2,
                'tags' => 'computer,electronics,professional',
                'description' => 'A high-performance camera for professional use.'
            ],
            [
                'slug'  => 'vacuum',
                'name'  => 'Vacuum',
                'nickname' => 'Vac',
                'partno' => 'VQ-001',
                'link' => 'https://example.com/vacuum',
                'datasheet' => 'https://example.com/vacuum/datasheet',
                'specification' => 'Powerful vacuum cleaner for home and office use.',
                'handlinginstruction' => 'Keep away from water and heat sources.',
                'unit_id' => 3,
                'category_id' => 3,
                'tags' => 'vacuum,office,supplies',
                'description' => 'A powerful vacuum cleaner for home and office use.'
            ],
             [
                'slug'  => 'tablet',
                'name'  => 'Tablet',
                'nickname' => 'Tab',
                'partno' => 'MC-001',
                'link' => 'https://example.com/mechanical',
                'datasheet' => 'https://example.com/mechanical/datasheet',
                'specification' => 'Mechanical components for various applications.',
                'handlinginstruction' => 'Store in a dry place. Avoid exposure to moisture.',
                'unit_id' => 4,
                'category_id' => 4,
                'tags' => 'mechanical,components,parts',
                'description' => 'A box of mechanical components for various applications.'
            ],
        ];

        $model = new \App\Models\Item;
        foreach ($data as $item) {
            $model->insert($item);
        }
    }
}
