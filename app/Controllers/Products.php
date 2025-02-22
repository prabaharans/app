<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use \App\Models\ProductsModel;
use \App\Models\WarehousesModel;
use \App\Models\ProductUomsModel;
use \App\Models\ProductWarehousesModel;
use \App\Models\ProductRacksModel;
use \App\Models\ProductBinsModel;
use \App\Models\ProductLabelsModel;
use \App\Models\ProductDetailsModel;
class Products extends BaseController
{
    public function index()
    {
        // $products = new ProductsModel();
        // $result = $products->getProductList();
        // echo '<pre>';
        // print_r($result);
        // echo '<pre>';
        // die;
        return view('products_view');
    }

    public function ajaxProductsDataTables()
    {
        $products = new ProductsModel();
        // $products->select('id, name, uom, quantity, status');

        // return DataTable::of($products)
        // ->add('warehouse', function($row){
        //     // $warehouses = new WarehousesModel();
        //     // $warehouses->select('GROUP_CONCAT(name SEPARATOR ",")')->where('product_id', $row->id)->groupBy('product_id');
        //     // echo '<pre>';
        //     // // print_r($row);
        //     // print_r($warehouses->get()->getResultArray());
        //     // echo '</pre>';die;
        //     // return $warehouses->warehouse_name;
        //     return $row->id;
        // }, 'last')
        // ->add('rack', function($row){
        //     return $row->id;
        // }, 'last')
        // ->add('bin', function($row){
        //     return $row->id;
        // }, 'last')
        // ->add('product_labels', function($row){
        //     return $row->id;
        // }, 'last')
        // ->add('action', function($row){
        //     return '<button type="button" class="btn btn-primary btn-sm" onclick="alert(\'edit product: '.$row->name.'\')" ><i class="fas fa-edit"></i> Edit</button>';
        // }, 'last')
        // ->toJson();

        return $products->getProductList();
    }

    public function add()
    {
        return view('product_add_view');
    }

    public function edit($productId, $productUomId, $productWarehouseId, $productRackId, $productBinId, $productLabelId, $productDetailsId)
    {
        // $request = service('request');
        // $postData = $request->getPost();
        // echo '<pre>';
        // print_r($productId);
        // print_r($productWarehouseId);
        // print_r($productRackId);
        // print_r($productBinId);
        // echo '</pre>';
        // die;
        $productsModel = new ProductsModel();
        $warehousesModel = new ProductWarehousesModel();
        $racksModel = new ProductRacksModel();
        $binModel = new ProductBinsModel();
        $productDetailsModel = new ProductDetailsModel();
        $labelsModel = new ProductLabelsModel();
        $uomsModel = new ProductUomsModel();
        $data['product'] = $productsModel->find($productId);
        $data['uom'] = $uomsModel->join('uoms', 'uoms.id = product_uoms.uom_id', 'inner')->find($productUomId);
        $data['warehouse'] = $warehousesModel->join('warehouses', 'warehouses.id = product_warehouses.warehouse_id', 'inner')->find($productWarehouseId);
        $data['rack'] = $racksModel->join('racks', 'racks.id = product_racks.rack_id', 'inner')->find($productRackId);
        $data['bin'] = $binModel->join('bins', 'bins.id = product_bins.bin_id', 'inner')->find($productBinId);
        $arrProductLabelId = explode('_',$productLabelId);
        $data['label'] = $labelsModel->select('GROUP_CONCAT(DISTINCT(product_labels.id) SEPARATOR "_") as plid, GROUP_CONCAT(DISTINCT(labels.id) SEPARATOR "_") as label_id, GROUP_CONCAT(DISTINCT(labels.name) SEPARATOR ",") as labels_name')->join('labels', 'labels.id = product_labels.label_id', 'inner')->whereIn('product_labels.id',$arrProductLabelId)->asArray()->find();
        $data['details'] = $productDetailsModel->find($productDetailsId);
        // echo '<pre>';
        // print_r($data);
        // echo '<pre>';
        // die;
        return view('product_edit_view', $data);
    }

    public function update()
    {
        return false;
    }
}
