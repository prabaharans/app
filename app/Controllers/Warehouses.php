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
}
