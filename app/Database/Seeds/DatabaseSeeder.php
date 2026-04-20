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
        $this->call('CompanyContactsSeeder');
        $this->call('ItemUnitsSeeder');
        $this->call('UserCategoriesSeeder');
        $this->call('WarehousesSeeder');
        $this->call('WarehouseStatusesSeeder');
        $this->call('ItemsSeeder');
        $this->call('WarehouseLocationsSeeder');
        $this->call('InvoiceStatusSeeder');
        $this->call('QuotationStatusSeeder');
        $this->call('PurchaseRequestStatusSeeder');
        $this->call('PurchaseRequestsSeeder');
        $this->call('PurchaseCategoriesSeeder');
    }
}
