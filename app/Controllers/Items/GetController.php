<?php
namespace App\Controllers\Items;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class GetController extends BaseController
{
    use ResponseTrait;

    public function index()
    {

        return view('items/list/index');
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

        $itemModel = model(\App\Models\Item::class);

        // Total records (no filter)
        $recordsTotal = $itemModel->countAll();

        $builder = $itemModel
            ->select('slug, name, nickname, partno, link, datasheet, specification, 
                        handlinginstruction, description, tags, category_id, unit_id');

        if (! empty($search)) {
            $builder->groupStart()
                ->like('name', $search)
                ->orLike('nickname', $search)
                ->orLike('partno', $search)
                ->groupEnd();
        }

        // Filtered count
        $recordsFiltered = $builder->countAllResults(false);

        // Pagination
        $data = $builder
            ->limit($length, $start)
            ->get()
            ->getCustomResultObject(\App\Entities\Item::class);

            foreach($data as &$item){

        $item->category = $item->category_details;
        unset($item->category_id);
        $item->unit = $item->unit_details;
        unset($item->unit_id);
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

        $model = new \App\Models\Item;

        $item = $model->select('name, nickname, partno, link, datasheet, specification, 
        handlinginstruction, description, tags, unit_id, category_id')
            ->where('name', $slug)
            ->first();
        $item->category = $item->category_details;
        unset($item->category_id);
        $item->unit = $item->unit_details;
        unset($item->unit_id);

        return $this->response->setJSON(compact('item'));
    }
}
