<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Invoice extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
    
    protected $hidden = [
        'company_id',
        'contact_id'
    ];

    public function getCategoryDetails(){

        $model = new \App\Models\Companies;

        return $model->select('name, slug')->where('id', $this->company_id)->first();
    }

    public function getUnitDetails(){

        $model = new \App\Models\CompanyContact;

        return $model->select('name, slug')->where('id', $this->contact_id)->first();
    }
}
