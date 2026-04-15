<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Warehouse extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
    
    protected $hidden = [
        'location_primary_id',
        'location_secondary_id',
        'status_id'
    ];

    public function getStatusDetails(){

        $model = new \App\Models\WarehouseStatus;

        return $model->select('name, slug')->where('id', $this->status_id)->first();
    }

    public function getPrimaryDetails(){

        $model = new \App\Models\WarehouseLocation;

        return $model->select('institute, slug')->where('id', $this->location_primary_id)->first();
    }
    
    public function getSecondaryDetails(){

        $model = new \App\Models\WarehouseLocation;
        
        return $model->select('institute, slug')->where('id', $this->location_secondary_id)->first();
    }
}
