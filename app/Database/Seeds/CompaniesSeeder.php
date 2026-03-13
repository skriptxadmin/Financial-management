<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CompaniesSeeder extends Seeder
{
    public function run()
    {
        $data = [
           [ 'slug' => 'skriptx', 'name' => 'Skriptx', 'email' => 'mailtoskriptx@gmail.com', 
            'phone' => '9042013581', 'website' => 'https://www.skriptx.com', 
            'address_line_1' => '87 Indra Nagar,', 'address_line_2' => 'Marakkanam Road', 
            'category_id' => '1', 'location_id' => '1', 'pincode' => '604001', 
            'status_id' => '1', 'visible' => '1', 'notes' => 'notes about skriptx',]
            
        ];
        
        $model = new \App\Models\Company;
        foreach ($data as $item) {
            $model->insert($item);
        }
    }
}
