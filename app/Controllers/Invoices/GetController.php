<?php
namespace App\Controllers\Invoices;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class GetController extends BaseController
{
    use ResponseTrait;

    public function index()
    {

        return view('invoices/list/index');
    }

    public function paginated()
    {
        $draw   = (int) $this->request->getGet('draw');
        $start  = (int) $this->request->getGet('start');
        $length = (int) $this->request->getGet('length');

        $search = $this->request->getGet('search')['value'] ?? null;

        $page = ($start / $length) + 1;

        $invoiceModel = model(\App\Models\Invoice::class);

        // Total records (no filter)
        $recordsTotal = $invoiceModel->countAll();

        $builder = $invoiceModel
            ->select('slug, name,company_id,contact_id	,invoice_number,invoice_date,total_price,invoice_unique_id,	
reference_number,purchase_request_made,purchase_request_id');

        if (! empty($search)) {
            $builder->groupStart()
                ->like('slug', $search)
                ->orLike('name', $search)
                ->orLike('invoice_number', $search)
                 ->orLike('reference_number', $search)
                ->groupEnd();
        }

        // Filtered count
        $recordsFiltered = $builder->countAllResults(false);

        // Pagination
        $data = $builder
            ->limit($length, $start)
            ->get()
            ->getCustomResultObject(\App\Entities\Invoice::class);

            foreach($data as &$invoice){

        $invoice->companies = $invoice->companies_details;
        unset($invoice->company_id);
        $invoice->contact = $invoice->contact_details;
        unset($invoice->contact_id);
            }

        return $this->response->setJSON([
            "draw"            => intval($draw),
            "recordsTotal"    => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data"            => $data,
        ]);
    }
    public function get($slug)
    {

        $model = new \App\Models\Invoice;

        $invoice = $model->select('slug, name, company_id, contact_id, invoice_number, 
        invoice_date, total_price, invoice_unique_id, reference_number, purchase_request_made, purchase_request_id')
            ->where('slug', $slug)
            ->first();
        $invoice->companies = $invoice->companies_details;
        unset($invoice->company_id);
        $invoice->contact = $invoice->contact_details;
        unset($invoice->contact_id);

        return $this->response->setJSON(compact('invoice'));
    }
}
