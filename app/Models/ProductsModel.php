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
        $this->select('products.id as pid, products.name');
        // $this->select('CONCAT(warehouses.name," / ",racks.name, " / ", bins.name) as warehouses_name');
        // $this->select('GROUP_CONCAT(DISTINCT(warehouses.name) SEPARATOR ",") as warehouses_name');
        // $this->select('GROUP_CONCAT(DISTINCT(racks.name) SEPARATOR ",") as racks_name');
        // $this->select('GROUP_CONCAT(DISTINCT(bins.name) SEPARATOR ",") as bins_name');
        $this->select('uoms.name as uoms_name');
        $this->select('warehouses.name as warehouses_name');
        $this->select('racks.name as racks_name');
        $this->select('bins.name as bins_name');
        $this->select('GROUP_CONCAT(DISTINCT(labels.name) SEPARATOR ",") as labels_name');
        $this->select('product_details.quantity, products.status');
        $this->select('product_uoms.id as puid, product_warehouses.id as pwid, product_racks.id as prid, product_bins.id as pbid, product_details.id as pdid');
        // $this->select('GROUP_CONCAT(DISTINCT(labels.id) SEPARATOR ",") as lid');
        $this->select('GROUP_CONCAT(DISTINCT(product_labels.id) SEPARATOR "_") as plid');
        $this->select('GROUP_CONCAT(DISTINCT(labels.id) SEPARATOR "_") as lid');
        $this->select('warehouses.id as wid, racks.id as rid, bins.id as bid, uoms.id as uid ');
        $this->join('product_warehouses', 'product_warehouses.product_id = products.id', 'inner');
        $this->join('warehouses', 'warehouses.id = product_warehouses.warehouse_id', 'inner');
        $this->join('product_racks', 'product_warehouses.id = product_warehouse_id', 'inner');
        $this->join('racks', 'racks.id = product_racks.rack_id', 'inner');
        $this->join('product_bins', 'product_racks.id = product_rack_id', 'inner');
        $this->join('bins', 'bins.id = product_bins.bin_id', 'inner');
        $this->join('product_details', 'product_bins.id = product_bin_id', 'inner');
        $this->join('product_labels', 'product_labels.product_id = products.id');
        $this->join('labels', 'labels.id = product_labels.label_id', 'inner');
        $this->join('product_uoms', 'product_uoms.product_id = products.id');
        $this->join('uoms', 'uoms.id = product_uoms.uom_id', 'inner');
        $this->groupBy('products.id');
        $this->groupBy('product_uoms.id');
        $this->groupBy('product_warehouses.id');
        $this->groupBy('product_racks.id');
        $this->groupBy('product_bins.id');
        // $this->groupBy('product_labels.id');
        $this->groupBy('product_details.id');
        return $this;
    }

}
