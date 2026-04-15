<?php
namespace App\Controllers\Invoices;

use App\Controllers\BaseController;

class PostController extends BaseController
{
    public function index()
    {
        $slug = '';
        return view('invoices/form/index', compact('slug'));
    }

    public function save()
    {
        // Define validation rules
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
                'rules'  => 'permit_empty|alpha_numeric|min_length[2]|max_length[100]',
                'errors' => [
                    'alpha_numeric' => 'Invoice unique ID can only contain letters and numbers',
                    'min_length'    => 'Invoice unique ID must be at least 2 characters',
                    'max_length'    => 'Invoice unique ID cannot exceed 100 characters',
                ],
            ],
            'reference_number'  => [
                'rules'  => 'permit_empty|alpha_numeric|min_length[2]|max_length[100]',
                'errors' => [
                    'alpha_numeric' => 'Reference number can only contain letters and numbers',
                    'min_length'    => 'Reference number must be at least 2 characters',
                    'max_length'    => 'Reference number cannot exceed 100 characters',
                ],
            ],
            'purchase_request_made'  => [
                    'rules'  => 'permit_empty|in_list[0,1]',
                    'errors' => [
                        'in_list' => 'Purchase request made must be either 0 (No) or 1 (Yes)',
                    ],
            ],
            'purchase_request_id'  => [
                'rules'  => 'permit_empty|min_length[2]|max_length[255]',
                'errors' => [
                    'min_length'  => 'Purchase request ID must be at least 2 characters',
                    'max_length'  => 'Purchase request ID cannot exceed 255 characters',
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

        $companycontactModel = new \App\Models\Invoice;
        
        $companycontact = $companycontactModel
            ->where('slug', $validatedData['contact_id'])
            ->select('id')
            ->first();
        $validatedData['contact_id'] = $companycontact->id;

        $companieModel = new \App\Models\Invoice;
        
        $companie= $companieModel
            ->where('slug', $validatedData['companie'])
            ->select('id')
            ->first();

        $validatedData['company_id'] = $companie->id;

        unset($validatedData['companie']);
        unset($validatedData['contact_id']);


        helper('slug');

        $invoiceModel = new \App\Models\Invoice;

        $validatedData['slug'] = generateUniqueSlug($validatedData['name'], $invoiceModel);

        

        try {
            $invoiceModel->save($validatedData);
            return $this->response->setJSON(['success' => true, 'redirect' => base_url('invoices')]);

        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['message' => $e->getMessage()]);
        }
    }
}