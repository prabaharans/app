<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use \App\Models\UomsModel;
class Uoms extends BaseController
{
    public function index()
    {
        return view('uoms_view');
    }

    public function ajaxUomsDataTables()
    {
        $uoms = new UomsModel();
        $uoms->select('id, name, status');

        return DataTable::of($uoms)
        ->add('action', function($row){
            return '<button type="button" class="btn btn-primary btn-sm" onclick="alert(\'edit uom: '.$row->name.'\')" ><i class="fas fa-edit"></i> Edit</button>';
        }, 'last')
        ->toJson();
    }

    public function getUoms($limit = 10, $offset = 0)
    {
        $request = service('request');
        $postData = $request->getPost();

        $response = array();

        // Read new token and assign in $response['token']
        $response['token'] = csrf_hash();
        $page = ($postData['page']) ?? 1;
        $offset = ($page - 1) * $limit;
        // Fetch record
        $uoms = new UomsModel();
        $uoms->select('id,name')->orderBy('name')->asArray();
        if(isset($postData['searchTerm'])){
            $searchTerm = $postData['searchTerm'];
            $uoms->like('name',$searchTerm);
        }
        $uomsCount = $uoms->countAllResults();
        $uomsList = $uoms->findAll($limit, $offset);
        $endCount = $offset + $limit;
        $morePages = $endCount < $uomsCount;
        $data = array();
        foreach($uomsList as $uom){
            $data[] = array(
                "id" => $uom['id'],
                "text" => $uom['name'],
            );
        }

        $response['data'] = $data;
        $response['pagination']['more'] = $morePages;
        return $this->response->setJSON($response);
    }
}
