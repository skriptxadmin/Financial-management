<?php
namespace App\Entities;

use CodeIgniter\Entity\Entity;

class CompanyContact extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = ['working' => 'boolean'];

    public function getCompanyDetails()
    {

        $model = new \App\Models\Company;

        return $model->select('name, slug')->where('id', $this->company_id)->first();
    }

    public function getStatusDetails()
    {

        $model = new \App\Models\CompanyContactStatus;

        return $model->select('name, slug')->where('id', $this->status_id)->first();
    }

}
