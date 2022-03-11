<?php

namespace App\Controllers;

use App\Models\VTypeModel;

class Home extends BaseController
{
    public function index()
    {
        //echo "Welcome";

        // if (session()->get('uType') == 'a') {
        //     echo 'Admin';
        // } elseif (session()->get('uType') == 'p') {
        //     echo 'Passenger';
        // } else {
        //     echo 'driver';
        // }

        if(session()->get('isLoggedIn')){
            echo view('dashBoard');
        }else{
            return redirect()->to('/');
        }
        
    }

    public function dbase()
    {

        $this->load->database();
    }

    public function adminView(){

        $data = [];
        print view('Admin/adminView', $data);
    }


    public function mkrequest(){
        
        $session = \Config\Services::session();
        $data["session"] = $session;
        $db      = \Config\Database::connect();
        $data = [];

        $model2 = new VTypeModel();        
        $tList = $model2->findAll();


        
        $data['types'] = $tList;

        // $data = [];
        print view('Passenger/Make_request', $data);

    }

    public function dlist(){

        $data = [];
        return view('Admin/driverList', $data);

    }
}
