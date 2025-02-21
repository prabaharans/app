<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use \App\Models\WarehousesModel;


class Warehouses extends BaseController
{
    public function index()
    {
        return view('warehouses_view');
    }

    public function ajaxWareHouseDataTables()
    {
        $warehouses = new WarehousesModel();
        $warehouses->select('id, name, status');

        return DataTable::of($warehouses)
        ->add('action', function($row){
            return '<button type="button" class="btn btn-primary btn-sm" onclick="alert(\'edit warehouse: '.$row->name.'\')" ><i class="fas fa-edit"></i> Edit</button>';
        }, 'last')
        ->toJson();
    }

    public function getWarehouses($limit = 5, $offset = 10)
    {
        $request = service('request');
        $postData = $request->getPost();

        $response = array();

        // Read new token and assign in $response['token']
        $response['token'] = csrf_hash();

        // Fetch record
        $warehouses = new WarehousesModel();
        $warehousesList = $warehouses->select('id,name')
        if(isset($postData['searchTerm'])){
            $searchTerm = $postData['searchTerm'];
            $warehousesList->like('name',$searchTerm);
        }
        $warehousesList->orderBy('name')->findAll($limit, $offset);
        $data = array();
        foreach($warehousesList as $warehouse){
        $data[] = array(
            "id" => $warehouse['id'],
            "text" => $warehouse['name'],
        );

        $response['data'] = $data;

        return $this->response->setJSON($response);
    }
}
