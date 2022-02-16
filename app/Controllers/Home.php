<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        //echo "Welcome";
       echo view('Admin/index');
       
    }

    public function dbase(){

        $this->load->database();
    }
}
