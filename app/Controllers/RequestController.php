<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VTypeModel;

class RequestController extends BaseController
{
    public function index()
    {

        $session = \Config\Services::session();
        $data["session"] = $session;
        $db      = \Config\Database::connect();
        $data = [];

        $model2 = new VTypeModel();        
        $tList = $model2->findAll();


        
        $data['types'] = $tList;
        echo json_encode($data);
        // return view('Passenger/Make_request', $data);
    }


    public function get(){

        
    }
}
