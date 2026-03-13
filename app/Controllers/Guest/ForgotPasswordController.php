<?php
namespace App\Controllers\Guest;

use App\Controllers\BaseController;
use Carbon\Carbon;

class ForgotPasswordController extends BaseController
{
    public function index()
    {
        return view('guest/forgot-password');
    }

    public function forgot_password()
    {

        $postData = $this->request->getPost();

        $rules = [
            'username' => 'required',
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

        helper('otp');

        $otp =  generate_otp();

        $expiresAt = Carbon::now()->addMinutes(5)->toDateTimeString();

        $data = [
            'otp' => $otp,
            'otp_expires_at' => $expiresAt
        ];

        $model->update($user->id, $data);

        session()->set('user_otp_generated', ['otp' => $otp, 'username'=>$user->username]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'OTP generated successfully',
            'redirect' => base_url('set-password')
        ]);
    }
}
