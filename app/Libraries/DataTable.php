<?php

namespace App\Libraries;

use CodeIgniter\Model;

class DataTable
{
    protected $model;
    protected $request;
    protected $columns = [];

    public function __construct(Model $model, array $columns)
    {
        $this->model = $model;
        $this->request = service('request');
        $this->columns = $columns;
    }

    public function make()
    {
        $draw   = $this->request->getGet('draw');
        $start  = $this->request->getGet('start');
        $length = $this->request->getGet('length');

        $search = $this->request->getGet('search')['value'] ?? null;

        $builder = $this->model->builder();
        $builder->select(implode(',', $this->columns));
        // SEARCH
        if ($search) {
            $builder->groupStart();
            foreach ($this->columns as $column) {
                $builder->orLike($column, $search);
            }
            $builder->groupEnd();
        }

        $filtered = $builder->countAllResults(false);

        // ORDER
        $order = $this->request->getPost('order');
        if ($order) {
            $columnIndex = $order[0]['column'];
            $dir = $order[0]['dir'];

            $builder->orderBy($this->columns[$columnIndex], $dir);
        }

        // LIMIT
        $builder->limit($length, $start);

        $data = $builder->get()->getResult();

        $total = $this->model->countAll();

        return response()->setJSON([
            "draw" => intval($draw),
            "recordsTotal" => $total,
            "recordsFiltered" => $filtered,
            "data" => $data
        ]);
    }
}