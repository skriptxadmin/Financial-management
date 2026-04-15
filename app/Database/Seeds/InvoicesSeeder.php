<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InvoicesSeeder extends Seeder 
{
    public function run()
    {
         $data = [
            [
                'slug'  => 'pencil',
                'name'  => 'Pencil',
                'company_id' => 1,
                'contact_id' => 1,
                'invoice_number' => 'INV-001',
                'invoice_date' => '2023-01-01',
                'total_price' => '10.00',
                'invoice_unique_id' => 'INV-001-UNIQUE',
                'reference_number' => 'REF-001',
                'purchase_request_made' => 1,
                'purchase_request_id' => 'PR-001',
                
            ],
            
        ];

        $model = new \App\Models\Invoice;
        foreach ($data as $invoice) {
            $model->insert($invoice);
        }
    }
}
