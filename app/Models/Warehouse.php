<?php

namespace App\Models;

use CodeIgniter\Model;

class Warehouse extends Model
{
    protected $table            = 'warehouses';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Warehouse::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['slug', 'name', 'location_primary_id', 'location_secondary_id', 'status_id', 'deleted_by'];

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

    protected function setStatus(array $data)
{
    if (isset($data['data']['status_id'])) {

            $model = new \App\Models\WarehouseStatus();

        $status = $model
            ->where('slug', $data['data']['status_id'])
            ->select('id')
            ->first();
        $data['data']['status_id'] = !empty($status->id) ? $status->id : -1;
    }
    return $data;
}
protected function setPrimary(array $data)
{
    if (isset($data['data']['location_primary_id'])) {

        $model = new \App\Models\WarehouseLocation();

        $location = $model
            ->where('slug', $data['data']['location_primary_id'])
            ->select('id')
            ->first();
        $data['data']['location_primary_id'] = !empty($location->id) ? $location->id : -1;
    }
    return $data;
}
protected function setSecondary(array $data)
{
    if (isset($data['data']['location_secondary_id'])) {

        $model = new \App\Models\WarehouseLocation();

        $location = $model
            ->where('slug', $data['data']['location_secondary_id'])
            ->select('id')
            ->first();
        $data['data']['location_secondary_id'] = !empty($location->id) ? $location->id : -1;
    }
    return $data;
}
}
