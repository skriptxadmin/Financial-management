<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Company extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function getCategoryDetails(){

        $model = new \App\Models\CompanyCategory;

        return $model->select('name, slug')->where('id', $this->category_id)->first();
    }

    public function getLocationDetails(){

        $model = new \App\Models\CompanyLocation;

        return $model->select('state,city,country')->where('id', $this->location_id)->first();
    }

     public function getStatusDetails(){

        $model = new \App\Models\CompanyStatus;

        return $model->select('name, slug')->where('id', $this->status_id)->first();
    }
}
