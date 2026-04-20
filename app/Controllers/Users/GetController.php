<?php
namespace App\Controllers\Users;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class GetController extends BaseController
{
    use ResponseTrait;

    public function index()
    {

        return view('users/list/index');
    }

    public function paginated()
    {
        $draw   = (int) $this->request->getGet('draw');
        $start  = (int) $this->request->getGet('start');
        $length = (int) $this->request->getGet('length');

        $search = $this->request->getGet('search')['value'] ?? null;

        $page = ($start / $length) + 1;

        $userModel = model(\App\Models\User::class);

        // Total records (no filter)
        $recordsTotal = $userModel->countAll();

        $builder = $userModel
            ->select('id, firstname, lastname, username, email, mobile, blocked_at, visible');

        if (! empty($search)) {
            $builder->groupStart()
                ->like('firstname', $search)
                ->orLike('lastname', $search)
                ->orLike('email', $search)
                ->orLike('mobile', $search)
                ->orLike('username', $search)
                ->groupEnd();
        }

        // Filtered count
        $recordsFiltered = $builder->countAllResults(false);

        // Pagination
        $data = $builder
            ->limit($length, $start)
            ->get()
            ->getResultArray();

        return $this->response->setJSON([
            "draw"            => intval($draw),
            "recordsTotal"    => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data"            => $data,
        ]);
    }

   
    public function get($username)
    {

        $model = new \App\Models\User();

        $user = $model->select('username, email, mobile, firstname, lastname, gender, role_id')
            ->where('username', $username)
            ->first();
        $user->role = $user->role_details;
        unset($user->role_id);

        return $this->response->setJSON(compact('user'));
    }
}
