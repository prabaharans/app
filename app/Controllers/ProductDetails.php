<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use \App\Models\ProductsModel;
use \App\Models\ProductUomsModel;
use \App\Models\ProductWarehousesModel;
use \App\Models\ProductRacksModel;
use \App\Models\ProductBinsModel;
use \App\Models\ProductLabelsModel;
use \App\Models\ProductDetailsModel;
class ProductDetails extends BaseController
{
    public function index()
    {
        return view('products_details_view');
    }



    public function ajaxProductDetailsDataTables()
    {
        $products = new ProductsModel();

        $result = $products->getProductList();
        return DataTable::of($result)->addNumbering('no')
        ->add('action', function($row){
            $pid = $row->pid;
            $puid = $row->puid;
            $pwid = $row->pwid;
            $prid = $row->prid;
            $pbid = $row->pbid;
            $plid = $row->plid;
            $pdid = $row->pdid;
            return '<button type="button" data-href="'.site_url('product-detail/edit/'.$pid.'/'.$puid.'/'.$pwid.'/'.$prid.'/'.$pbid.'/'.$plid.'/'.$pdid).'" class="btn btn-primary btn-sm" data-pid="'.$pid.'" data-puid="'.$puid.'" data-pwid="'.$pwid.'" data-prid="'.$prid.'" data-pbid="'.$pbid.'" data-plid="'.$plid.'" data-pdid="'.$pdid.'" data-wid="'.$row->wid.'" data-wname="'.$row->warehouses_name.'" data-uid="'.$row->uid.'" data-uname="'.$row->uoms_name.'" data-rid="'.$row->rid.'" data-rname="'.$row->racks_name.'" data-bid="'.$row->bid.'" data-bname="'.$row->bins_name.'" data-lid="'.$row->lid.'" data-lname="'.$row->labels_name.'" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fas fa-edit"></i> Edit</button>';
        }, 'last')
        ->hide('pid')
        ->hide('puid')
        ->hide('pwid')
        ->hide('prid')
        ->hide('pbid')
        ->hide('plid')
        ->hide('pdid')
        ->hide('wid')
        ->hide('uid')
        ->hide('rid')
        ->hide('bid')
        ->hide('lid')
        ->toJson(true);
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
        return view('product_detail_edit_view', $data);
    }

    public function update()
    {
        return false;
    }
}
