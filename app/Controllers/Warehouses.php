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

    public function getWarehouses($limit = 10, $offset = 0)
    {
        $request = service('request');
        $postData = $request->getPost();

        $response = array();

        // Read new token and assign in $response['token']
        $response['token'] = csrf_hash();
        $page = ($postData['page']) ?? 1;
        $offset = ($page - 1) * $limit;

        // Fetch record
        $warehouses = new WarehousesModel();
        // $warehouses = model(WarehousesModel::class);
        $warehouses->select('id,name')->orderBy('name')->asArray();
        if(isset($postData['wid'])){
            $wid = $postData['wid'];
            $warehouse = $warehouses->find($wid);
            $data[] = array(
                "id" => $warehouse['id'],
                "text" => $warehouse['name'],
            );
            $response['data'] = $data;
        } else {
            if(isset($postData['searchTerm'])){
                $searchTerm = $postData['searchTerm'];
                $warehouses->like('name',$searchTerm);
            }
            $warehousesCount = $warehouses->countAllResults();
            $warehousesList = $warehouses->findAll($limit, $offset);
            // $query = $warehouses->getLastQuery();
            // if ($query->hasError()) {
            //     echo 'Code: ' . $query->getErrorCode();
            //     echo 'Error: ' . $query->getErrorMessage();
            //     die;
            // }
            $endCount = $offset + $limit;
            $morePages = $endCount < $warehousesCount;

            $data = array();
            foreach($warehousesList as $warehouse){
                $data[] = array(
                    "id" => $warehouse['id'],
                    "text" => $warehouse['name'],
                );
            }

            $response['data'] = $data;
            $response['pagination']['more'] = $morePages;
        }
        return $this->response->setJSON($response);
    }
}
