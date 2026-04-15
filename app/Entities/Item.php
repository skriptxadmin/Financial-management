<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Item extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
    
    protected $hidden = [
        'unit_id',
        'category_id'
    ];

    public function getCategoryDetails(){

        $model = new \App\Models\ItemCategory;

        return $model->select('name, slug')->where('id', $this->category_id)->first();
    }

    public function getUnitDetails(){

        $model = new \App\Models\ItemUnit;

        return $model->select('name, slug')->where('id', $this->unit_id)->first();
    }
}
