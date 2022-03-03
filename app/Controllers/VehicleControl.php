<?php

namespace App\Controllers;

use App\Controllers\BaseController;
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


        try {

            $builder->select('*');
            $builder->join('vehicle_master_data', 'vehicle_master_data.vm_id = vehicles.vm_id');
            $builder->join('user_details', 'user_details.uid = vehicles.uid','left');
            // $builder->select('vehicles.*','vehicle_master_data.vm_id','vehicle_master_data.v_type');
            
            // $builder->select('user_details.uid','user_details.name1','user_details.name2');
            $builder->orderBy('vehicles.v_id');
            $vList = $builder->get()->getResultArray();
            echo "<script>console.log('" . json_encode($vList)  . "' );</script>";
        
            $tList = $model2->findAll();
        } catch (\Exception $e) {

            die($e->getMessage());
            echo "<script>console.log('" . json_encode($e)  . "' );</script>";
            $data["status"]  = $e;
            echo json_encode($data);
        }




        $data['vehicles'] = $vList;
        $data['types'] = $tList;

        // print view('Admin/adminView');
        print view('Admin/vList.php', $data);
    }

    public function deleteVehicle()
    {

        $data = [];

        try {

            $model = new VehicleModel();
            $id = $this->request->getPost("vid");
            $thisItem = $model->find($id);


            if ($thisItem['v_delStatus'] == "n") {
                $stat = array('v_delStatus' => "y");
                $model->update($id, $stat);
            } else {
                $stat = array('v_delStatus' => "n");
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

    public function getVehicle()
    {

        try {

            $model = new VehicleModel();
            $searchId = $this->request->getPost("vid");
            $data['vehicles'] = $model->find($searchId);
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
