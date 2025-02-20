<?php

namespace App\Models;

use CodeIgniter\Model;
use \Hermawan\DataTables\DataTable;

class ProductsModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
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

    public function getProductList()
    {
        $this->select('products.id, products.name, products.uom');
        $this->select('GROUP_CONCAT(DISTINCT(warehouses.name) SEPARATOR ",") as warehouses_name');
        $this->select('GROUP_CONCAT(DISTINCT(racks.name) SEPARATOR ",") as racks_name');
        $this->select('GROUP_CONCAT(DISTINCT(bins.name) SEPARATOR ",") as bins_name');
        $this->select('GROUP_CONCAT(DISTINCT(labels.name) SEPARATOR ",") as labels_name');
        $this->select('products.quantity, products.status');
        $this->join('product_warehouses', 'product_warehouses.product_id = products.id', 'inner');
        $this->join('warehouses', 'warehouses.id = product_warehouses.warehouse_id', 'inner');
        $this->join('product_racks', 'product_warehouses.id = product_warehouse_id', 'inner');
        $this->join('racks', 'racks.id = product_racks.rack_id', 'inner');
        $this->join('product_bins', 'product_racks.id = product_rack_id', 'inner');
        $this->join('bins', 'bins.id = product_bins.bin_id', 'inner');
        $this->join('product_labels', 'product_labels.product_id = products.id', 'inner');
        $this->join('labels', 'labels.id = product_labels.label_id', 'inner');
        $this->groupBy('products.id');
        return DataTable::of($this)
        ->add('action', function($row){
            return '<button type="button" class="btn btn-primary btn-sm" onclick="alert(\'edit product: '.$row->name.'\')" ><i class="fas fa-edit"></i> Edit</button>';
        }, 'last')
        ->toJson();
    }
}
