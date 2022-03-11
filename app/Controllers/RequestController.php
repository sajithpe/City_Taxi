<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DriverModel;
use App\Models\VehicleModel;
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
        $model3 = new DriverModel();     
       
        // $tList = $model2->findAll();
       
        
        // $builder = $db->table('user_details');
        
        // try {
            
           
            
        //     // // $builder->select('*');
        //     $query = $builder->getWhere(['userType'=>'d', 'delStatus'=>'n']);
        //     $builder->orderBy('user_details.uid');            
        //     $data['users'] = $query->getResultArray();

        //     return $this->response->setJSON($data);

        // } catch (\Exception $e) {

        //     die($e->getMessage());
        //     $data["status"]  = $e;
        //     echo json_encode($data);
        // }
        


        
        // $data['types'] = $tList;
        // echo json_encode($data);
        // return view('Passenger/Make_request', $data);
    }


    public function save_request(){
       



        
    }

    public function save()
    {

        $data = [];
        //request model create and set here.
        $model = new VehicleModel();
        $formdata = [
            "vm_id" => $this->request->getPost("v_type"),
            "v_number" => $this->request->getPost("v_number"),
            "v_model" => $this->request->getPost("v_model"),
            "v_brand" => $this->request->getPost("v_brand"),
            "v_delStatus" => "n"
        ];

        try {

            $model->save($formdata);

            $data["status"]  = 'data saved successfully';
            echo json_encode($data);
        } catch (\Exception $e) {

            die($e->getMessage());
            $data["status"]  = $e;
            echo json_encode($data);
        }
    }
}
