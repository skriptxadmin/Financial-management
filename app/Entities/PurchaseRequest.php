<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PurchaseRequest extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function getCompanyDetails(){

        $model = new \App\Models\Company;

        return $model->select('name, slug')->where('id', $this->company_id)->first();
    }

    public function getContactDetails(){

        $model = new \App\Models\CompanyContact;

        return $model->select('name, slug')->where('id', $this->company_contact_id)->first();
    }

    public function getStatusDetails(){

        $model = new \App\Models\PurchaseRequestStatus;

        return $model->select('name, slug')->where('id', $this->status_id)->first();
    }

}

