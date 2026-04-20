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

    public function getCategoryDetails(){

        $model=new \App\Models\PurchaseCategory;

        return $model->select('name, slug, head_user_id')->where('id', $this->category_id)->first();
    }

    public function getStatusDetails(){

        $model = new \App\Models\PurchaseRequestStatus;

        return $model->select('name, slug')->where('id', $this->status_id)->first();
    }

     public function getItemDetails(){

        $model = new \App\Models\PurchaseRequestItem;

        $items = $model->select('item_id, price, subtotal, tax, tax_amount, total')->where('purchase_request_id', $this->id)->findAll();

        foreach($items as &$item){

            $itemModel = new \App\Models\Item;

            $item->item = $itemModel->select('name, slug')->where('id', $item->item_id)->first();    
        }

         return $items;

    }
}

