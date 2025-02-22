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

    public function getBins($limit = 10, $offset = 0)
    {
        $request = service('request');
        $postData = $request->getPost();

        $response = array();

        // Read new token and assign in $response['token']
        $response['token'] = csrf_hash();
        $page = ($postData['page']) ?? 1;
        $offset = ($page - 1) * $limit;
        // Fetch record
        $bins = new BinsModel();
        $bins->select('id,name')->orderBy('name')->asArray();
        if(isset($postData['searchTerm'])){
            $searchTerm = $postData['searchTerm'];
            $bins->like('name',$searchTerm);
        }
        $binsCount = $bins->countAllResults();
        $binsList = $bins->findAll($limit, $offset);
        $endCount = $offset + $limit;
        $morePages = $endCount < $binsCount;
        $data = array();
        foreach($binsList as $bin){
            $data[] = array(
                "id" => $bin['id'],
                "text" => $bin['name'],
            );
        }

        $response['data'] = $data;
        $response['pagination']['more'] = $morePages;
        return $this->response->setJSON($response);
    }
}
