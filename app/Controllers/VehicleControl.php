<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\VehicleModel;
use App\Models\VTypeModel;

class VehicleControl extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();
        $data["session"] = $session;
        $db      = \Config\Database::connect();
        $builder = $db->table('vehicles');


        $model = new VehicleModel();
        $model2 = new VTypeModel();
        $model3 = new UserModel();


        try {

            $builder->select('*');
            $builder->join('vehicle_master_data', 'vehicle_master_data.vm_id = vehicles.vm_id');
            $builder->join('user_details', 'user_details.uid = vehicles.uid','left');
            $builder->orderBy('vehicles.v_id');
            $vList = $builder->get()->getResultArray();

            $builder = $db->table('user_details');
            $query = $builder->getWhere(['userType'=>'d', 'delStatus'=>'n']);
            $builder->orderBy('user_details.uid');            
            $dList = $query->getResultArray();
        
            $tList = $model2->findAll();
            // $dList = $model3->findAll();
        } catch (\Exception $e) {

            die($e->getMessage());
            echo "<script>console.log('" . json_encode($e)  . "' );</script>";
            $data["status"]  = $e;
            echo json_encode($data);
        }




        $data['vehicles'] = $vList;
        $data['types'] = $tList;
        $data['users'] = $dList;
       

        // print view('Admin/adminView');
        print view('Admin/vList.php', $data);
    }


    public function setDriver(){

        $data = [];
        
        try {

            $model = new VehicleModel();
            $vid = $this->request->getPost("vid");
            $did = $this->request->getPost("did");
            $thisItem = $model->find($vid);
            
            $stat = array('uid' => $did);
            $model->update($vid, $stat);
            

            
            $data['status'] = "Updated Successfully...!";
            return $this->response->setJSON($data);

        } catch (\Exception $e) {

            die($e->getMessage());
            $data["status"]  = $e;
            
            echo json_encode($data);
        }

    }

    public function drivers(){

       
        $data = [];
        $session = \Config\Services::session();
        $data["session"] = $session;
        $db      = \Config\Database::connect();
        $builder = $db->table('user_details');
        
        
        try {
           
            
            // // $builder->select('*');
            $query = $builder->getWhere(['userType'=>'d', 'delStatus'=>'n']);
            $builder->orderBy('user_details.uid');            
            $data['users'] = $query->getResultArray();

            return $this->response->setJSON($data);

        } catch (\Exception $e) {

            die($e->getMessage());
            $data["status"]  = $e;
            echo json_encode($data);
        }
        
        
        // return view('Admin/driverList', $data);
    }

    public function deleteVehicle()
    {
        
        $data = [];
        
        try {

            $model = new VehicleModel();
            $vid = $this->request->getPost("v_id");
            $thisItem = $model->find($vid);
            

            if ($thisItem['v_delStatus'] == "n") {
                $stat = array('v_delStatus' => "y");
                $model->update($vid, $stat);
            } else {
                $stat = array('v_delStatus' => "n");
                $model->update($vid, $stat);
            }

            
            $data['status'] = "Updated Successfully...!";
            return $this->response->setJSON($data);

        } catch (\Exception $e) {

            die($e->getMessage());
            $data["status"]  = $e;
            
            echo json_encode($data);
        }
    }

    public function getVehicle()
    {
        $data = [];
        $session = \Config\Services::session();
        $data["session"] = $session;
        $db      = \Config\Database::connect();
        $builder = $db->table('vehicles');
        
        try {
           

            $model = new VehicleModel();
            $searchId = $this->request->getPost("vid");
            // $data['vehicles'] = $model->find($searchId);
            // $builder->select('*');
            // $builder->getWhere(['vehicles.v_id'=>$searchId]);
            $builder->join('vehicle_master_data', 'vehicle_master_data.vm_id = vehicles.vm_id');
            $builder->join('user_details', 'user_details.uid = vehicles.uid','left');
            $builder->orderBy('vehicles.v_id');            
            // $data['vehicles'] = $builder->get()->getResult();
            $query = $builder->getWhere(['vehicles.v_id'=>$searchId]);
            $data['vehicles'] = $query->getResultArray();

            return $this->response->setJSON($data);
        } catch (\Exception $e) {

            die($e->getMessage());
            $data["status"]  = $e;
            echo json_encode($data);
        }
    }

    public function updateVehicle()
    {

        $data = [];
        $vid = $this->request->getPost("vid");
        $model = new VehicleModel();
        $formdata = [
            "v_type" => $this->request->getPost("v_type"),
            "v_number" => $this->request->getPost("v_number"),
            "v_model" => $this->request->getPost("v_model"),
            "v_brand" => $this->request->getPost("v_brand"),
        ];

        try {

            $model->update($vid, $formdata);

            $data["status"]  = 'data saved successfully';
            echo json_encode($data);
        } catch (\Exception $e) {

            die($e->getMessage());
            echo "<script>console.log('" . json_encode($e)  . "' );</script>";
            $data["status"]  = $e;
            echo json_encode($data);
        }
    }

    public function saveVehicle()
    {

        $data = [];
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
