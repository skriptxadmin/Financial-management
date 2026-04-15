<?php

namespace App\Models;

use CodeIgniter\Model;

class Invoice extends Model
{
    protected $table            = 'invoice';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\Invoice::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['slug','company_id','contact_id','invoice_number','invoice_date','total_price','invoice_unique_id','reference_number','purchase_request_made','purchase_request_id'];

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

    protected function setCompany(array $data)
{
    if (isset($data['data']['company_id'])) {

        $model = new \App\Models\Company();

        $company = $model
            ->where('slug', $data['data']['company_id'])
            ->select('id')
            ->first();
        $data['data']['company_id'] = !empty($company->id) ? $company->id : -1;
    }
    return $data;
}
protected function setContact(array $data)
{
    if (isset($data['data']['contact_id'])) {

        $model = new \App\Models\Contact();

        $contact = $model
            ->where('slug', $data['data']['contact_id'])
            ->select('id')
            ->first();
        $data['data']['contact_id'] = !empty($contact->id) ? $contact->id : -1;
    }
    return $data;
}
}


