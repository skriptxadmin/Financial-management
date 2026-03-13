<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'visible' => 'boolean'
    ];

     protected $hidden = [
        'password',
        'role_id'
    ];

     public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }
    
    public function isBlocked(): bool
    {
        return ! empty($this->blocked_at);
    }

    public function getRoleDetails(){

        $model = new \App\Models\UserRole;

        return $model->select('name, slug')->where('id', $this->role_id)->first();
    }
}
