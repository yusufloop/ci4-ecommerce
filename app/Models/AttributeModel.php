<?php

namespace App\Models;

use CodeIgniter\Model;

class AttributeModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'attributes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'App\Entities\AttributesEntity';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['code', 'name', 'type', 'validation', 'is_required', 'is_unique', 'is_filterable', 'is_configurable'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'code' => 'required|min_length[3]',
        'name' => 'required',
        'type' => 'required',
    ];
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

    public const ATTRIBUTE_TYPES = [
		''         => '-- Please Choose --',
		'select'   => 'Select',
		'text'     => 'Text',
		'textarea' => 'Textarea',
		'price'    => 'Price',
		'boolean'  => 'Boolean',
		'datetime' => 'Datetime',
		'date'     => 'Date',
	];

	public const IS_REQUIRED_OPTIONS = [
		'' => '-- Please Choose --',
		0  => 'No',
		1  => 'Yes',
	];

	public const IS_UNIQUE_OPTIONS = [
		'' => '-- Please Choose --',
		0  => 'No',
		1  => 'Yes',
	];

	public const VALIDATIONS = [
		''        => '-- Please Choose --',
		'number'  => 'Number',
		'decimal' => 'Decimal',
		'email'   => 'Email',
		'url'     => 'URL',
	];

	public const IS_CONFIGURABLE_OPTIONS = [
		'' => '-- Please Choose --',
		0  => 'No',
		1  => 'Yes',
	];

	public const IS_FILTERABLE_OPTIONS = [
		'' => '-- Please Choose --',
		0  => 'No',
		1  => 'Yes',
	];
}
