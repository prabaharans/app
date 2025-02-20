<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use \App\Models\LabelsModel;
class Labels extends BaseController
{
    public function index()
    {
        return view('labels_view');
    }

    public function ajaxLabelsDataTables()
    {
        $labels = new LabelsModel();
        $labels->select('id, name, status');

        return DataTable::of($labels)
        ->add('action', function($row){
            return '<button type="button" class="btn btn-primary btn-sm" onclick="alert(\'edit label: '.$row->name.'\')" ><i class="fas fa-edit"></i> Edit</button>';
        }, 'last')
        ->toJson();
    }
}
