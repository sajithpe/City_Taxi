<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VTypeModel;

class VTypeControl extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();
        $data["session"] = $session;


        $model = new VTypeModel() ;
        $vtList = $model->findAll();
        $data['types'] = $vtList;

        // print view('Admin/adminView');
        print view('Admin/vTypeList.php', $data);
    }

    public function deleteType(){

        $data = [];

        try {

            $model = new VTypeModel();
            $id = $this->request->getPost("vmid");
            $thisItem = $model->find($id);
                      

            if($thisItem['delStatus'] == "n"){
                $stat = array('delStatus' => "y");
                $model->update($id, $stat);

            }else{
                $stat = array('delStatus' => "n");
                $model->update($id, $stat);
            }

            
            $data['status'] = "Updated Successfully...!";
            return $this->response->setJSON($data);

        } catch (\Exception $e) {

            die($e->getMessage());
            $data["status"]  = $e;
            echo json_encode($data);
        }

    }

    public function updateType(){

        $data = [];
        $vmid = $this->request->getPost("vmid");
        $model = new VTypeModel();
        $formdata = [

            "v_type" => $this->request->getPost("v_type"),
            "cost_km" => $this->request->getPost("cost_km"),
            "fuel_type" => $this->request->getPost("fuel_type"),
            "driver_pay" => $this->request->getPost("driver_pay"),
            
        ];

        try {

            $model->update($vmid, $formdata);

            $data["status"]  = 'data saved successfully';
            echo json_encode($data);
        } catch (\Exception $e) {

            die($e->getMessage());
            echo "<script>console.log('". json_encode($e)  . "' );</script>";
            $data["status"]  = $e;
            echo json_encode($data);
        }

    }

    public function getType(){

        try {

            $model = new VTypeModel();
            $searchId = $this->request->getPost("vmid");
            $data['type'] = $model->find($searchId);
            return $this->response->setJSON($data);
        } catch (\Exception $e) {

            die($e->getMessage());
            $data["status"]  = $e;
            echo json_encode($data);
        }

    }

    public function saveType(){

        $data = [];
        $model = new VTypeModel();
        $formdata = [

            "v_type" => $this->request->getPost("v_type"),
            "cost_km" => $this->request->getPost("cost_km"),
            "fuel_type" => $this->request->getPost("fuel_type"),
            "driver_pay" => $this->request->getPost("driver_pay"),
            "delStatus" => "n"
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
