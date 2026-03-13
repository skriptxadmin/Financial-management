<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
         $this->call('UserRolesSeeder');
         $this->call('UsersSeeder');
         $this->call('CompanyCategoriesSeeder');
         $this->call('CompanyStatusSeeder');
         $this->call('CompanyLocationsTableSeeder');
         $this->call('CompaniesSeeder');
	 $this->call('ItemCategoriesSeeder');
         $this->call('CompanyContactStatusSeeder');
    }
}
