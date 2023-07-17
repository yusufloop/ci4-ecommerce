<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AttributeModel;
use App\Models\AttributeOptionModel;

class AttributeOptionsController extends BaseController
{
    protected $attributeModel;
    protected $attributeOptionModel;
    protected $perPage = 10;

    public function __construct()
    {
        $this->attributeModel = new AttributeModel;
        $this->attributeOptionModel = new AttributeOptionModel;

        $this->data['currentAdminMenu'] = 'catalogue';
        $this->data['currentAdminSubMenu'] = 'attribute_option';
    }
    public function index($attributeId = null, $attributeOptionId = null)
    {
        if(!$attributeId)
        {
            $this->session->setFlashdata('error', 'Invalid attributes');
            return redirect()->to('/admin/attributes');
        }
        if($attributeId)
        {
            $attribute = $this->attributeModel->find($attributeId);
            if(!$attribute)
            {
                $this->session->setFlashdata('error', 'Invalid attributes');
                return redirect()->to('/admin/attributes');
            }
            $this->data['attribute'] = $attribute;
        }
        
        if($attributeOptionId)
        {
            $attributeOption = $this->attributeOptionModel->find($attributeOptionId);

            if(!$attributeOption)
            {
                $this->session->setFlashdata('error', 'Invalid attributes option');
                return redirect()->to('/admin/attributes');
            }

            $this->data['attributeOption'] = $attributeOption;

        }

        $this->getAttributeOptions($attributeId);

        return view('admin/attribute_options/index', $this->data);
    }

    private function getAttributeOptions($attributeId)
    {
        $this->data['attributeOptions'] = $this->attributeOptionModel->where('attribute_id', $attributeId)->paginate($this->perPage, 'bootstrap');
        $this->data['pager'] = $this->attributeOptionModel->pager;
    }
}
