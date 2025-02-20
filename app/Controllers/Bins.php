<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use \App\Models\BinsModel;

class Bins extends BaseController
{
    public function index()
    {
        return view('bins_view');
    }

    public function ajaxBinsDataTables()
    {
        $bins = new BinsModel();
        $bins->select('id, name, status');

        return DataTable::of($bins)
        ->add('action', function($row){
            return '<button type="button" class="btn btn-primary btn-sm" onclick="alert(\'edit bin: '.$row->name.'\')" ><i class="fas fa-edit"></i> Edit</button>';
        }, 'last')
        ->toJson();
    }
}
