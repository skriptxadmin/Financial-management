<?php
namespace App\Controllers\Guest;

use App\Controllers\BaseController;
use Carbon\Carbon;

class SetPasswordController extends BaseController
{
    public function index()
    {
        $user_otp_generated = session()->get('user_otp_generated');

        if (empty($user_otp_generated)) {

            return redirect()->to('/');
        }

        $data = $user_otp_generated;

        session()->remove('user_otp_generated');

        return view('guest/set-password', $data);
    }

    public function set_password()
    {

        $postData = $this->request->getPost();

        $rules = [
            'username'  => 'required',
            'otp'       => 'required',
            'password'  => 'required',
            'cpassword' => 'required|matches[password]',
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

        $now = Carbon::now()->toDateTimeString();

        $user = $model->where('username', $validatedData->username)
            ->where('otp', $validatedData->otp)
            ->where('otp_expires_at >=', $now)
            ->first();
        if (! $user) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => 'error',
                    'message' => 'User not found',
                ]);
        }

        $data = [
            'otp'            => null,
            'otp_expires_at' => null,
            'verified_at'    => $now,
        ];

        $model->update($user->id, $data);

        return $this->response->setJSON([
            'status'   => 'success',
            'message'  => 'Password updated successfully',
            'redirect' => base_url('/'),
        ]);
    }
}
