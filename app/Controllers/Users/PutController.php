<?php
namespace App\Controllers\Users;

use App\Controllers\BaseController;

class PutController extends BaseController
{
    public function index($username)
    {

        return view('users/form/index', compact('username'));

    }

    public function save($username)
    {
                                    // Define validation rules
        $usernameParam = $username; // username from URL or function parameter

        $rules = [
            'firstname' => [
                'rules' => 'required|alpha_space|min_length[2]|max_length[50]',
            ],

            'lastname'  => [
                'rules' => 'required|alpha_space|min_length[2]|max_length[50]',
            ],

            'username'  => [
                'rules' => "required|alpha_numeric|min_length[4]|max_length[30]|is_unique[users.username,username,{$usernameParam}]",
                'errors'    => [
                    'is_unique' => 'Username already exists',
                ],
            ],

            'email'  => [
                'rules' => "required|valid_email|is_unique[users.email,username,{$usernameParam}]",
                'errors' => [
                    'is_unique' => 'Email already exists',
                ],
            ],

            'mobile' => [
                'rules' => "required|numeric|exact_length[10]|is_unique[users.mobile,username,{$usernameParam}]",
                'errors' => [
                    'is_unique' => 'Mobile number already exists',
                ],
            ],

            'password' => [
                'rules' => 'permit_empty|min_length[8]|max_length[15]',
            ],

            'role' => [
                'rules' => 'required|is_not_unique[user_roles.slug]',
            ],

            'gender' => [
                'rules' => 'required|in_list[m,f,o]',
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
            unset($validatedData['password']);
        }

        unset($validatedData['role']);

        $userModel = new \App\Models\User();

        try {
             $userModel->where('username', $usernameParam)
              ->set($validatedData)
              ->update();
            return $this->response->setJSON(['success' => true, 'redirect' => base_url('users')]);

        } catch (\Exception $e) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['message' => $e->getMessage()]);
        }

    }
}
