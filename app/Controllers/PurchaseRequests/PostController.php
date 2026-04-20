<?php
namespace App\Controllers\PurchaseRequests;

use App\Controllers\BaseController;

class PostController extends BaseController
{
    public function index()
    {
        $slug = '';
        return view('purchase-requests/form/index', compact('slug'));
    }

    public function save()
    {

        $rules = [

            'title'              => [
                'rules'  => 'required|min_length[2]|max_length[50]',
                'errors' => [
                    'required'   => 'Title is required',
                    'min_length' => 'Title must be at least 2 characters',
                    'max_length' => 'Title cannot exceed 50 characters',
                ],
            ],

            'company'            => [
                'rules'  => 'required|min_length[2]|max_length[50]|is_not_unique[companies.slug]',
                'errors' => [
                    'required'      => 'Company is required',
                    'min_length'    => 'Company must be at least 2 characters',
                    'max_length'    => 'Company cannot exceed 50 characters',
                    'is_not_unique' => 'Selected company does not exist',
                ],
            ],

            'companyContact'     => [
                'rules'  => 'required|min_length[2]|max_length[50]|is_not_unique[company_contacts.slug]',
                'errors' => [
                    'required'      => 'Company contact is required',
                    'min_length'    => 'Company contact must be at least 2 characters',
                    'max_length'    => 'Company contact cannot exceed 50 characters',
                    'is_not_unique' => 'Selected contact does not exist',
                ],
            ],

            'category'           => [
                'rules'  => 'required|is_not_unique[purchase_categories.slug]',
                'errors' => [
                    'required'      => 'Category is required',
                    'is_not_unique' => 'Selected category does not exist',
                ],
            ],

            'discount'           => [
                'rules'  => 'required|decimal',
                'errors' => [
                    'required' => 'Discount is required',
                    'decimal'  => 'Discount must be a valid number (e.g., 10.00)',
                ],
            ],

            'payable'            => [
                'rules'  => 'required|decimal',
                'errors' => [
                    'required' => 'Payable amount is required',
                    'decimal'  => 'Payable must be a valid number',
                ],
            ],

            'tax'                => [
                'rules'  => 'required|decimal',
                'errors' => [
                    'required' => 'Tax is required',
                    'decimal'  => 'Tax must be a valid number',
                ],
            ],

            'total'              => [
                'rules'  => 'required|decimal',
                'errors' => [
                    'required' => 'Total is required',
                    'decimal'  => 'Total must be a valid number',
                ],
            ],

            'items'              => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'At least one item is required',
                ],
            ],

            'items.*.item'       => [
                'rules'  => 'required|is_not_unique[items.name]',
                'errors' => [
                    'required'      => 'Item name is required',
                    'is_not_unique' => 'Selected item does not exist',
                ],
            ],

            'items.*.price'      => [
                'rules'  => 'required|decimal',
                'errors' => [
                    'required' => 'Item price is required',
                    'decimal'  => 'Item price must be a valid number',
                ],
            ],

            'items.*.quantity'   => [
                'rules'  => 'required|decimal',
                'errors' => [
                    'required' => 'Quantity is required',
                    'decimal'  => 'Quantity must be a valid number',
                ],
            ],

            'items.*.subtotal'   => [
                'rules'  => 'required|decimal',
                'errors' => [
                    'required' => 'Subtotal is required',
                    'decimal'  => 'Subtotal must be a valid number',
                ],
            ],

            'items.*.tax'        => [
                'rules'  => 'required|decimal',
                'errors' => [
                    'required' => 'Item tax is required',
                    'decimal'  => 'Item tax must be a valid number',
                ],
            ],

            'items.*.tax_amount' => [
                'rules'  => 'required|decimal',
                'errors' => [
                    'required' => 'Tax amount is required',
                    'decimal'  => 'Tax amount must be a valid number',
                ],
            ],

            'items.*.total'      => [
                'rules'  => 'required|decimal',
                'errors' => [
                    'required' => 'Item total is required',
                    'decimal'  => 'Item total must be a valid number',
                ],
            ],
            'notes' => [
                'rules' => 'required|min_length[2]|max_length[500]'
            ]
        ];
        // Validate input
        if (! $this->validate($rules)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['errors' => $this->validator->getErrors()]);
        }

        $validatedData = $this->validator->getValidated();

        helper('slug');

        $model = new \App\Models\PurchaseRequest;

        $validatedData['slug'] = generateUniqueSlug($validatedData['title'], $model);

        $companyModel = new \App\Models\Company;

        $company = $companyModel->where('slug', $validatedData['company'])->first();

        $companyContactModel = new \App\Models\CompanyContact;

        $company_contact = $companyContactModel->where('slug', $validatedData['companyContact'])
            ->where('company_id', $company->id)
            ->first();

        if (empty($company_contact)) {

            return $this->response
                ->setStatusCode(422)
                ->setJSON(['errors' => 'Company contact does not match']);
        }

        $categoryModel = new \App\Models\PurchaseCategory;
        $category = $categoryModel->where('slug', $validatedData['category'])->first();

        $args = [
            'title'              => $validatedData['title'],
            'slug'               => $validatedData['slug'],
            'company_id'            => $company->id,
            'company_contact_id' => $company_contact->id,
            'category_id'        => $category->id,
            'request_id'         => date('YmdHis'),
            'discount'           => $validatedData['discount'],
            'tax'                => $validatedData['tax'],
            'payable'            => $validatedData['payable'],
            'total'              => $validatedData['total'],
            'notes'              => $validatedData['notes'],
            'status_id'            => 1
        ];

        $model->save($args);

        $insertId = $model->getInsertID();

        if (empty($insertId)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['errors' => 'Purchase request cannot be recorded']);

        }

        $itemModel = new \App\Models\Item;

        $items = (array) $validatedData['items'];

        $item_slugs = array_map(function ($x) {
            return $x['item'];
        }, $items);

        $itemsWithSlugIds = $itemModel
            ->whereIn('slug', $item_slugs)
            ->select('id, slug')
            ->findAll();

        $itemWithMaps = [];

        foreach ($itemsWithSlugIds as $x) {
            $itemWithMaps[$x->slug] = $x->id;
        }

        foreach ($items as &$item) {
            $item['item_id'] = $itemWithMaps[$item['item']];
            unset($item['item']);
            $item['purchase_request_id'] = $insertId;
        }

        $requestItemModel = new \App\Models\PurchaseRequestItem;

        $requestItemModel->insertBatch($items);

        return $this->response
            ->setJSON(['success' => true, 'redirect' => base_url('purchase-requests')]);

    }
}
