<?php
namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\User::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['username', 'role_id', 'firstname', 'lastname', 'gender', 
    'notes' ,'email', 'mobile', 'password', 'otp','otp_expires_at', 'blocked_at', 'verified_at','deleted_by', 'visible'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts        = [
        'visible' => 'boolean'
    ];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword', 'setRole'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['hashPassword', 'setRole'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {

            // prevent double hashing
            if (! password_get_info($data['data']['password'])['algo']) {
                $data['data']['password'] =
                    password_hash($data['data']['password'], PASSWORD_DEFAULT);
            }
        }

        return $data;
    }

   protected function setRole(array $data)
{
    if (isset($data['data']['role_id'])) {

        $model = new \App\Models\UserRole();

        $role = $model
            ->where('slug', $data['data']['role_id'])
            ->select('id')
            ->first();

        $data['data']['role_id'] = !empty($role->id) ? $role->id : -1;
    }

    return $data;
}
}
