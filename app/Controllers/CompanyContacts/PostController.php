<?php
namespace App\Controllers\CompanyContacts;

use App\Controllers\BaseController;

class PostController extends BaseController
{
    public function index($companySlug)
    {
        $slug = null;

        return view('company-contacts/form/index', compact('slug', 'companySlug'));
    }

    public function save()
    {

        $rules = [
            'name'        => [
                'rules'  => 'required|min_length[2]|max_length[50]|regex_match[/^[A-Za-z\s]+$/]',
                'errors' => [
                    'required'    => 'Name is required',
                    'min_length'  => 'Name must be at least 2 characters',
                    'max_length'  => 'Name cannot exceed 50 characters',
                    'regex_match' => 'Name can only contain letters and spaces',
                ],
            ],

            'email'       => [
                'rules'  => 'required|valid_email|max_length[100]',
                'errors' => [
                    'required'    => 'Email is required',
                    'valid_email' => 'Enter a valid email address',
                    'max_length'  => 'Email cannot exceed 100 characters',
                ],
            ],

            'phone'       => [
                'rules'  => 'required|min_length[7]|max_length[15]|regex_match[/^[0-9+\-\s]+$/]',
                'errors' => [
                    'required'    => 'Phone number is required',
                    'min_length'  => 'Phone number must be at least 7 characters',
                    'max_length'  => 'Phone number cannot exceed 15 characters',
                    'regex_match' => 'Phone number can contain digits, +, - and spaces',
                ],
            ],
            'designation' => [
                'rules'  => 'required|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z\s]+$/]',
                'errors' => [
                    'required'    => 'Designation is required',
                    'min_length'  => 'Designation must be at least 7 characters',
                    'max_length'  => 'Designation  cannot exceed 15 characters',
                    'regex_match' => 'Designation can contain alphabets and spaces',
                ],
            ],

            'company'     => [
                'rules'  => 'required|is_not_unique[companies.slug]',
                'errors' => [
                    'required' => 'Please select a company',
                ],
            ],
            'notes'       => [
                'rules'  => 'permit_empty|max_length[250]',
                'errors' => [
                    'max_length' => 'Address cannot exceed 250 characters',
                ],
            ],
        ];

        if (! $this->validate($rules)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['errors' => $this->validator->getErrors()]);
        }

        $validatedData = $this->validator->getValidated();

        $companyModel = new \App\Models\Company;

        $company = $companyModel->select('id')
            ->where('slug', $validatedData['company'])
            ->first();
        if (empty($company)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['errors' => ['Company is invalid']]);

        }

        $user = session()->get('user');

        helper('slug');

        $model = new \App\Models\CompanyContact;

        $slug = generateUniqueSlug($validatedData['name'], $model);

        $data = [
            'slug'        => $slug,
            'name'        => $validatedData['name'],
            'email'       => $validatedData['email'],
            'phone'       => $validatedData['phone'],
            'designation' => $validatedData['designation'],
            'company_id'  => $company->id,
            'created_by'  => $user->id,
            'notes'       => $validatedData['notes'],
        ];

        $model->insert($data);

        return $this->response->setJSON(['success' => true, 'redirect' => base_url('company-contacts/' . $validatedData['company'])]);
    }
}
