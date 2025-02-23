<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use \App\Models\ProductsModel;
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
        $products->select('id, name, status');

        return DataTable::of($products)
        ->add('action', function($row){
            return '<button type="button" class="btn btn-primary btn-sm" onclick="alert(\'edit product: '.$row->name.'\')" ><i class="fas fa-edit"></i> Edit</button>';
        }, 'last')
        ->toJson();
    }

    public function getProducts($limit = 10, $offset = 0)
    {
        $request = service('request');
        $postData = $request->getPost();

        $response = array();

        // Read new token and assign in $response['token']
        $response['token'] = csrf_hash();
        $page = ($postData['page']) ?? 1;
        $offset = ($page - 1) * $limit;
        // Fetch record
        $products = new ProductsModel();
        $products->select('id,name')->orderBy('name')->asArray();
        if(isset($postData['searchTerm'])){
            $searchTerm = $postData['searchTerm'];
            $products->like('name',$searchTerm);
        }
        $productsCount = $products->countAllResults();
        $productsList = $products->findAll($limit, $offset);
        $endCount = $offset + $limit;
        $morePages = $endCount < $productsCount;
        $data = array();
        foreach($productsList as $product){
            $data[] = array(
                "id" => $product['id'],
                "text" => $product['name'],
            );
        }

        $response['data'] = $data;
        $response['pagination']['more'] = $morePages;
        return $this->response->setJSON($response);
    }
}
