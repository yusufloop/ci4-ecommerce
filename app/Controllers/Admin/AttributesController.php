<?php

namespace App\Controllers\Admin;

use App\Models\AttributeModel;
use App\Controllers\BaseController;

class AttributesController extends BaseController
{
    protected $attributeModel;
    protected $perPage = 10;

    public function __construct()
    {
        $this->attributeModel = new AttributeModel();

        $this->data['attributeTypes'] = $this->attributeModel::ATTRIBUTE_TYPES;
        $this->data['isRequiredOptions'] = $this->attributeModel::IS_REQUIRED_OPTIONS;
        $this->data['isUniqueOptions'] = $this->attributeModel::IS_UNIQUE_OPTIONS;
        $this->data['validations'] = $this->attributeModel::VALIDATIONS;
        $this->data['isConfigurableOptions'] = $this->attributeModel::IS_CONFIGURABLE_OPTIONS;
        $this->data['isFilterableOptions'] = $this->attributeModel::IS_FILTERABLE_OPTIONS;
        
        $this->data['currentAdminMenu'] = 'attribute';
        $this->data['currentAdminSubMenu'] = 'attribute';
    }
    public function index($attributesId = null)
    {
        if($attributesId)
        {
            $attribute = $this->attributeModel->find($attributesId);
            if(!$attribute)
            {
                $this->session->setFlashdata('errors', 'Invalid attributes');
                return redirect()->to('admin/attributes');
            }

            $this->data['attributes'] = $attribute;
        }
        $this->getAttributes();

        return view('admin/attributes/index', $this->data);
    }
    public function getAttributes()
    {
        $this->data['attributes'] = $this->attributeModel->paginate($this->perPage, 'bootstrap');
        $this->data['pager'] = $this->attributeModel->pager;
    }
    
    

    public function store()
    {
        $params =[
            'code' => $this->request->getVar('code'),
            'name' => $this->request->getVar('name'),
            'type' => $this->request->getVar('type'),
            'is_required' => $this->request->getVar('is_required'),
            'is_unique' => $this->request->getVar('is_unique'),
            'validation' => $this->request->getVar('validation'),
            'is_configurable' => $this->request->getVar('is_configurable'),
            'is_filterable' => $this->request->getVar('is_filterable'),
        ];
        
        

        if($this->attributeModel->save($params))
        {
            $this->session->setFlashdata('success', 'attributes has been saved');
            return redirect()->to('admin/attributes');
        }
        else 
        {
            $this->getAttributes();
            
            $this->data['errors'] = $this->attributeModel->errors();
           
            return view('admin/attributes/index', $this->data);
        }
    }

    public function update($id)
    {
        $params = [
			'id' => $id,
            'code' => $this->request->getVar('code'),
            'name' => $this->request->getVar('name'),
            'type' => $this->request->getVar('type'),
            'is_required' => $this->request->getVar('is_required'),
            'is_unique' => $this->request->getVar('is_unique'),
            'validation' => $this->request->getVar('validation'),
            'is_configurable' => $this->request->getVar('is_configurable'),
            'is_filterable' => $this->request->getVar('is_filterable'),
        ];

		if ($this->attributeModel->save($params)) {
			$this->session->setFlashdata('success', 'attribute has been updated!');
			return redirect()->to('/admin/attributes');
		} else {
			$this->getAttributes();
			$this->data['errors'] = $this->attributeModel->errors();
			return view('admin/attributes/index', $this->data);
		}
    }


    public function destroy($id)
    {
        $attribute = $this->attributeModel->find($id);
		if (!$attribute) {
			$this->session->setFlashdata('errors', 'Invalid attributes');
			return redirect()->to('/admin/attributes');
		}

		if ($this->attributeModel->delete($attribute->id)) {
			$this->session->setFlashdata('success', 'The attributes has been deleted');
			return redirect()->to('/admin/attributes');
		} else {
			$this->session->setFlashdata('errors', 'Could not delete the attributes');
			return redirect()->to('/admin/attributes');
		}
    }
}
