<?php
namespace App\Controllers\Companies;

use App\Controllers\BaseController;

class GetController extends BaseController
{
    public function index()
    {
        return view('companies/list/index');
    }

    public function paginated()
    {
        $draw   = (int) $this->request->getGet('draw');
        $start  = (int) $this->request->getGet('start');
        $length = (int) $this->request->getGet('length');
        
        if(!$length) $length = 10;
        if(!$start) $start = 0;
        if(!$draw) $draw = 1;

        $search = $this->request->getGet('search')['value'] ?? null;

        $page = ($start / $length) + 1;

        $model = model(\App\Models\Company::class);

        // Total records (no filter)
        $recordsTotal = $model->countAll();

        $builder = $model
            ->select('name,slug, email, phone, website,location_id ,status_id, category_id, visible');

        if (! empty($search)) {
            $builder->groupStart()
                ->like('name', $search)
                ->orLike('email', $search)
                ->orLike('phone', $search)
                ->orLike('website', $search)
                ->groupEnd();
        }

        // Filtered count
        $recordsFiltered = $builder->countAllResults(false);

        // Pagination
        $data = $builder
            ->limit($length, $start)
            ->get()
            ->getCustomResultObject(\App\Entities\Company::class);

        foreach ($data as &$item) {
            $item->status = $item->statusDetails;
            $item->category = $item->categoryDetails;
        }

        return $this->response->setJSON([
            "draw"            => intval($draw),
            "recordsTotal"    => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data"            => $data ? array_values($data) : [],
        ]);
    }

    public function get($slug)
    {

        $model = new \App\Models\Company();

        $company = $model->select('name,slug, email, phone, website, address_line_1, address_line_2, pincode, location_id, notes, category_id ,status_id, visible')
            ->where('slug', $slug)
            ->first();
        $company->category = $company->category_details;
        $company->location = $company->location_details;

        return $this->response->setJSON(compact('company'));
    }
}
