<?php
namespace App\Controllers\Users;

use App\Controllers\BaseController;

class PostController extends BaseController
{
    public function index()
    {
        $username = '';
        return view('users/form/index', compact('username'));
    }

    public function save()
    {
        // Define validation rules
        $rules = [
            'firstname' => [
                'rules'  => 'required|alpha_space|min_length[2]|max_length[50]',
                'errors' => [
                    'required'    => 'Firstname is required',
                    'alpha_space' => 'Firstname can only contain letters and spaces',
                    'min_length'  => 'Firstname must be at least 2 characters',
                    'max_length'  => 'Firstname cannot exceed 50 characters',
                ],
            ],
            'lastname'  => [
                'rules'  => 'required|alpha_space|min_length[2]|max_length[50]',
                'errors' => [
                    'required'    => 'Lastname is required',
                    'alpha_space' => 'Lastname can only contain letters and spaces',
                    'min_length'  => 'Lastname must be at least 2 characters',
                    'max_length'  => 'Lastname cannot exceed 50 characters',
                ],
            ],
            'username'  => [
                'rules'  => 'required|alpha_numeric|min_length[4]|max_length[30]|is_unique[users.username]',
                'errors' => [
                    'required'      => 'Username is required',
                    'alpha_numeric' => 'Username can only contain letters and numbers',
                    'min_length'    => 'Username must be at least 4 characters',
                    'max_length'    => 'Username cannot exceed 30 characters',
                    'is_unique'     => 'Username already exists',
                ],
            ],
            'email'     => [
                'rules'  => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required'    => 'Email is required',
                    'valid_email' => 'Enter a valid email address',
                    'is_unique'   => 'Email already exists',
                ],
            ],
            'password'  => [
                'rules'  => 'permit_empty|min_length[8]|max_length[15]',
                'errors' => [
                    'min_length' => 'Password must be at least 8 characters',
                    'max_length' => 'Password cannot exceed 15 characters',
                ],
            ],
            'mobile'    => [
                'rules'  => 'required|numeric|min_length[10]|max_length[10]|is_unique[users.mobile]',
                'errors' => [
                    'required'   => 'Mobile number is required',
                    'numeric'    => 'Mobile number must contain only digits',
                    'min_length' => 'Mobile number must be at least 10 digits',
                    'max_length' => 'Mobile number cannot exceed 10 digits',
                ],
            ],
            'role'      => [
                'rules'  => 'required|is_not_unique[user_roles.slug]',
                'errors' => [
                    'required'      => 'Role is required',
                    'is_not_unique' => 'Invalid role selected',
                ],
            ],
            'gender'    => [
                'rules'  => 'required|in_list[m,f,o]',
                'errors' => [
                    'required' => 'Gender is required',
                    'in_list'  => 'Select a valid gender',
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

        $validatedData['role_id'] = $validatedData['role'];

        if (empty($validatedData['password'])) {
            $validatedData['password'] = bin2hex(random_bytes(6));
        }

        unset($validatedData['role']);

        $userModel = new \App\Models\User();

        try {
            $userModel->save($validatedData);
            return $this->response->setJSON(['success' => true, 'redirect' => base_url('users')]);

        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['message' => $e->getMessage()]);
        }

    }
}
