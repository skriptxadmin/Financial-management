<?php

namespace App\Models;

use CodeIgniter\Model;

class Item extends Model
{
    protected $table            = 'items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Item::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['slug','unit_id','category_id', 'name','nickname','partno','link','datasheet',
    'specification','handlinginstruction','tags','description','created_by','updated_by','deleted_by'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
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
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function setUnit(array $data)
{
    if (isset($data['data']['unit_id'])) {

        $model = new \App\Models\ItemUnit();

        $unit = $model
            ->where('slug', $data['data']['unit_id'])
            ->select('id')
            ->first();
        $data['data']['unit_id'] = !empty($unit->id) ? $unit->id : -1;
    }
    return $data;
}
protected function setCategory(array $data)
{
    if (isset($data['data']['category_id'])) {

        $model = new \App\Models\ItemCategory();

        $category = $model
            ->where('slug', $data['data']['category_id'])
            ->select('id')
            ->first();
        $data['data']['category_id'] = !empty($category->id) ? $category->id : -1;
    }
    return $data;
}
}


