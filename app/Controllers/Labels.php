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

    public function getLabels($limit = 10, $offset = 0)
    {
        $request = service('request');
        $postData = $request->getPost();

        $response = array();

        // Read new token and assign in $response['token']
        $response['token'] = csrf_hash();
        $page = ($postData['page']) ?? 1;
        $offset = ($page - 1) * $limit;
        // Fetch record
        $labels = new LabelsModel();
        $labels->select('id,name')->orderBy('name')->asArray();
        if(isset($postData['searchTerm'])){
            $searchTerm = $postData['searchTerm'];
            $labels->like('name',$searchTerm);
        }
        $labelsCount = $labels->countAllResults();
        $labelsList = $labels->findAll($limit, $offset);
        $endCount = $offset + $limit;
        $morePages = $endCount < $labelsCount;
        $data = array();
        foreach($labelsList as $label){
            $data[] = array(
                "id" => $label['id'],
                "text" => $label['name'],
            );
        }

        $response['data'] = $data;
        $response['pagination']['more'] = $morePages;
        return $this->response->setJSON($response);
    }
}
