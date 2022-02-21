<?php

namespace App\Controllers;

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
}
