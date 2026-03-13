<?php
namespace App\Controllers\Companies;

use App\Controllers\BaseController;

class PostController extends BaseController
{
    public function index()
    {
        $slug = null;

        return view('companies/form/index', compact('slug'));
    }

    public function save()
    {

        $rules = [
            'name'           => [
                'rules'  => 'required|min_length[2]|max_length[50]|regex_match[/^[A-Za-z\s]+$/]',
                'errors' => [
                    'required'    => 'Name is required',
                    'min_length'  => 'Name must be at least 2 characters',
                    'max_length'  => 'Name cannot exceed 50 characters',
                    'regex_match' => 'Name can only contain letters and spaces',
                ],
            ],

            'email'          => [
                'rules'  => 'required|valid_email|max_length[100]',
                'errors' => [
                    'required'    => 'Email is required',
                    'valid_email' => 'Enter a valid email address',
                    'max_length'  => 'Email cannot exceed 100 characters',
                ],
            ],

            'phone'          => [
                'rules'  => 'required|min_length[7]|max_length[15]|regex_match[/^[0-9+\-\s]+$/]',
                'errors' => [
                    'required'    => 'Phone number is required',
                    'min_length'  => 'Phone number must be at least 7 characters',
                    'max_length'  => 'Phone number cannot exceed 15 characters',
                    'regex_match' => 'Phone number can contain digits, +, - and spaces',
                ],
            ],

            'website'        => [
                'rules'  => 'required|valid_url',
                'errors' => [
                    'required'  => 'Website is required',
                    'valid_url' => 'Enter a valid website URL',
                ],
            ],

            'address_line_1' => [
                'rules'  => 'required|min_length[5]|max_length[150]',
                'errors' => [
                    'required'   => 'Address Line 1 is required',
                    'min_length' => 'Address must be at least 5 characters',
                    'max_length' => 'Address cannot exceed 150 characters',
                ],
            ],

            'address_line_2' => [
                'rules'  => 'permit_empty|max_length[150]',
                'errors' => [
                    'max_length' => 'Address cannot exceed 150 characters',
                ],
            ],

            'state'          => [
                'rules'  => 'required|regex_match[/^[A-Za-z\s]+$/]',
                'errors' => [
                    'required'    => 'State is required',
                    'regex_match' => 'State can only contain letters and spaces',
                ],
            ],

            'city'           => [
                'rules'  => 'required|regex_match[/^[A-Za-z\s]+$/]',
                'errors' => [
                    'required'    => 'City is required',
                    'regex_match' => 'City can only contain letters and spaces',
                ],
            ],

            'country'        => [
                'rules'  => 'required|regex_match[/^[A-Za-z\s]+$/]',
                'errors' => [
                    'required'    => 'Country is required',
                    'regex_match' => 'Country can only contain letters and spaces',
                ],
            ],

            'pincode'        => [
                'rules'  => 'required|exact_length[6]|numeric',
                'errors' => [
                    'required'     => 'Pincode is required',
                    'exact_length' => 'Pincode must be 6 digits',
                    'numeric'      => 'Pincode must contain only digits',
                ],
            ],
            'category'       => [
                'rules'  => 'required|is_not_unique[company_categories.slug]',
                'errors' => [
                    'required' => 'Please select a category',
                ],
            ],
               'notes' => [
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

        $locationModel = new \App\Models\CompanyLocation;

        $location = $locationModel->select('id')
            ->where('city', $validatedData['city'])
            ->where('state', $validatedData['state'])
            ->where('country', $validatedData['country'])
            ->first();
        if (empty($location)) {
            $data = [
                'city'    => $validatedData['city'],
                'state'   => $validatedData['state'],
                'country' => $validatedData['country'],
            ];

            $locationModel->insert($data);
            $locationId = $locationModel->insertID();
        } else {
            $locationId = $location->id;
        }

        $user = session()->get('user');

        helper('slug');

        $model= new \App\Models\Company;

        $slug = generateUniqueSlug($validatedData['name'], $model);

        $categoryModel = new \App\Models\CompanyCategory;

        $category = $categoryModel->where('slug', $validatedData['category'])->first();


        $data = [
            'slug' => $slug,
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'website' => $validatedData['website'],
            'address_line_1' => $validatedData['address_line_1'],
            'address_line_2' => $validatedData['address_line_2'],
            'pincode'   => $validatedData['pincode'],
            'location_id' => $locationId,
            'status_id' => 1,
            'category_id' => $category->id,
            'created_by' => $user->id,
            'notes' => $validatedData['notes'],
        ];

        $model->insert($data);

        return $this->response->setJSON(['success'=>true, 'redirect'=>base_url('companies')]);
    }
}
