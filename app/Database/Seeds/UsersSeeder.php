<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'  => 'administrator',
                'email'     => 'administrator@example.com',
                'mobile'    => '9042013581',
                'password'  => 'Password@123',
                'firstname' => 'Alaksandar Jesus',
                'lastname'  => 'Gene',
                'role_id'   => 'administrator',
                'gender'    => 'm',
            ],
        ];

        $model = new \App\Models\User;
        foreach ($data as $item) {
            $model->insert($item);
        }
    }
}
