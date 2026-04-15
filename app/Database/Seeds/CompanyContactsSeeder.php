<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CompanyContactsSeeder extends Seeder
{
    public function run()
    {
       $data =  [array(
                    'slug' => 'ams-alaksandar-jesus-gene',
                    'company_id' => '1',
                    'name' => 'AMS Alaksandar Jesus Gene',
                    'phone' => '9042013581',
                    'email' => 'alaksandarjesus@yahoo.co.in',
                    'designation' => 'Director',
                    'working' => '1',
                    'status_id' => '1',
                    'visible' => '1',
                    'notes' => 'Software Developer',
                    'approved_by' => NULL,
                    'rejected_by' => NULL,
                    'created_by' => '1',
                    'updated_by' => '1',
                    'deleted_by' => NULL,
                    'approved_at' => NULL,
                    'rejected_at' => NULL)];

         $model = new \App\Models\CompanyContact;
        foreach ($data as $item) {
            $model->insert($item);
        }

    }
}
