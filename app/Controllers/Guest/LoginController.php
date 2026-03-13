<?php
namespace App\Controllers\Guest;

use App\Controllers\BaseController;

class LoginController extends BaseController
{
    public function index()
    {
        return view('guest/login');
    }

    public function login()
    {

        $postData = $this->request->getPost();

        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON([
                    'status' => 'error',
                    'errors' => $this->validator->getErrors(),
                ]);
        }

        $validatedData = (object) $this->validator->getValidated();

        $model = new \App\Models\User;

        $user = $model->where('email', $validatedData->username)
            ->orWhere('username', $validatedData->username)
            ->orWhere('mobile', $validatedData->username)
            ->first();

        if (! $user) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'User not found',
                ]);
        }

        if($user->blocked_at){
            return $this->response
                    ->setStatusCode(401)
                    ->setJSON(['message'=>'Your access is blocked']);
        }

        if (! $user->verifyPassword($validatedData->password)) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'Invalid credentials',
                ]);
        }

        session()->set('user', $user);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Login Successful',
            'redirect' => base_url('/dashboard')
        ]);

    }
}
