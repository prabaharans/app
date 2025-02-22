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

    public function getRacks($limit = 10, $offset = 0)
    {
        $request = service('request');
        $postData = $request->getPost();

        $response = array();

        // Read new token and assign in $response['token']
        $response['token'] = csrf_hash();
        $page = ($postData['page']) ?? 1;
        $offset = ($page - 1) * $limit;
        // Fetch record
        $racks = new RacksModel();
        $racks->select('id,name')->orderBy('name')->asArray();
        if(isset($postData['searchTerm'])){
            $searchTerm = $postData['searchTerm'];
            $racks->like('name',$searchTerm);
        }
        $racksCount = $racks->countAllResults();
        $racksList = $racks->findAll($limit, $offset);
        $endCount = $offset + $limit;
        $morePages = $endCount < $racksCount;
        $data = array();
        foreach($racksList as $rack){
            $data[] = array(
                "id" => $rack['id'],
                "text" => $rack['name'],
            );
        }

        $response['data'] = $data;
        $response['pagination']['more'] = $morePages;
        return $this->response->setJSON($response);
    }
}
