<?php
namespace App\Controllers\CompanyContacts;

use App\Controllers\BaseController;

class GetController extends BaseController
{
    public function index($companySlug = null)
    {
        return view('company-contacts/list/index', compact('companySlug'));
    }

    public function paginated()
    {
        $draw        = (int) $this->request->getGet('draw');
        $start       = (int) $this->request->getGet('start');
        $length      = (int) $this->request->getGet('length');
        $companySlug = (int) $this->request->getGet('companySlug');

        $search = $this->request->getGet('search')['value'] ?? null;

        $page = ($start / $length) + 1;

        $model = model(\App\Models\CompanyContact::class);

        // Total records (no filter)
        $recordsTotal = $model->countAll();

        $builder = $model
            ->select('name,slug, email, phone, designation, status_id, company_id, visible, working');

        if (! empty($search)) {
            $builder->groupStart()
                ->like('name', $search)
                ->orLike('email', $search)
                ->orLike('phone', $search)
                ->groupEnd();
        }

        if (! $companySlug) {
            $companyModel = new \App\Models\Company;
            $company      = $companyModel->select('id')->where('slug', $companySlug)->first();
            if (! empty($company)) {
                $builder->where('company_id', $company->id);
            }
        }

        // Filtered count
        $recordsFiltered = $builder->countAllResults(false);

        // Pagination
        $data = $builder
            ->limit($length, $start)
            ->get()
            ->getCustomResultObject(\App\Entities\CompanyContact::class);

        foreach ($data as &$item) {
            $item->status = $item->statusDetails;
            $item->company = $item->companyDetails;
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

        $model = new \App\Models\CompanyContact();

        $contact = $model->select('name,slug, email, phone, designation,  notes, status_id, working, visible')
            ->where('slug', $slug)
            ->first();

        return $this->response->setJSON(compact('contact'));
    }
}
