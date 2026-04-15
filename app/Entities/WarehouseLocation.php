<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class WarehouseLocation extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [
        'visible' => 'boolean'
    ];

     protected $hidden = [
        'warehouse_id'
    ];

}