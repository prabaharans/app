<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use \App\Models\ProductsModel;
use \App\Models\WarehousesModel;
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
}
