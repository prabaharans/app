<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use \App\Models\RacksModel;

class Racks extends BaseController
{
    public function index()
    {
        return view('racks_view');
    }

    public function ajaxRacksDataTables()
    {
        $racks = new RacksModel();
        $racks->select('id, name, status');

        return DataTable::of($racks)
        ->add('action', function($row){
            return '<button type="button" class="btn btn-primary btn-sm" onclick="alert(\'edit rack: '.$row->name.'\')" ><i class="fas fa-edit"></i> Edit</button>';
        }, 'last')
        ->toJson();
    }
}
