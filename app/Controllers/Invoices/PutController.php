<?php
namespace App\Controllers\Invoices;

use App\Controllers\BaseController;

class PutController extends BaseController
{
    public function index($slug)
    {

        return view('invoices/form/index', compact('slug'));

    }

    public function save($slug)
    {
                                    // Define validation rules
        $invoicenameParam = $slug; // itemname from URL or function parameter
   
        $rules = [
            'company_id' => [
                'rules'  => 'permit_empty|alpha_space|min_length[2]|max_length[100]',
                'errors' => [
                    'alpha_space' => 'Company name can only contain letters and spaces',
                    'min_length'  => 'Company name must be at least 2 characters',
                    'max_length'  => 'Company name cannot exceed 100 characters',
                ],
            ],
            'contact_id' => [
                'rules'  => 'permit_empty|alpha_space|min_length[2]|max_length[100]',
                'errors' => [
                    'alpha_space' => 'Contact name can only contain letters and spaces',
                    'min_length'  => 'Contact name must be at least 2 characters',
                    'max_length'  => 'Contact name cannot exceed 100 characters',
                ],
            ],
            'invoice_number'    => [
                'rules'  => 'permit_empty|min_length[2]|max_length[100]',
                'errors' => [
                    'min_length'         => 'Invoice number must be at least 2 characters',
                    'max_length'         => 'Invoice number cannot exceed 100 characters',
                ],
            ],
            'invoice_date'      => [
                'rules'  => 'permit_empty|valid_date',
                'errors' => [
                    'valid_date' => 'Invalid invoice date',
                ],
            ],
            'total_price'  => [
                'rules'  => 'permit_empty|decimal[2]',
                'errors' => [
                    'decimal' => 'Total price must be a valid decimal number',
                ],
            ],
            'invoice_unique_id'      => [
                'rules'  => 'required|is_not_unique[invoices.slug]',
                'errors' => [
                    'required'   => 'Invoice unique ID is required',
                ],
            ],
            'reference_number'  => [
                'rules'  => 'required|is_not_unique[invoices.slug]',
                'errors' => [
                    'required'      => 'Category is required',
                ],
            ],
            'purchase_request_made'  => [
                'rules'  => 'permit_empty|in_list[0,1]',
                'errors' => [
                    'in_list' => 'Purchase request made must be either 0 (No) or 1 (Yes)',
                ],
            ],
            'purchase_request_id'  => [
                'rules'  => 'permit_empty|alpha_numeric|min_length[2]|max_length[100]',
                'errors' => [
                    'alpha_numeric' => 'Purchase request ID can only contain letters and numbers',
                    'min_length'    => 'Purchase request ID must be at least 2 characters',
                    'max_length'    => 'Purchase request ID cannot exceed 100 characters',
                ],
            ],
           
        ];
        // Validate input
        if (! $this->validate($rules)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['errors' => $this->validator->getErrors()]);
        }

        $validatedData = $this->validator->getValidated();

 $companyModel = new \App\Models\Companies;
        
        $company = $companyModel
            ->where('slug', $validatedData['company_id'])
            ->select('id')
            ->first();
        $validatedData['company_id'] = $company->id; // $validatedData['unit]

        $contactModel = new \App\Models\CompanyContact;
        
        $contact = $contactModel
            ->where('slug', $validatedData['contact_id'])
            ->select('id')
            ->first();

        $validatedData['contact_id'] = $contact->id;

        unset($validatedData['company_id']);
        unset($validatedData['contact_id']);

        $invoiceModel = new \App\Models\Invoice;

        try {
             $invoiceModel->where('name', $invoicenameParam)
              ->set($validatedData)
              ->update();
            return $this->response->setJSON(['success' => true, 'redirect' => base_url('invoice')]);

        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['message' => $e->getMessage()]);
        }

    }
}
