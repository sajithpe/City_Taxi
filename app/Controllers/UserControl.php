<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\CLI\Console;
use CodeIgniter\Model;

class UserControl extends BaseController
{

    public function index()
    {


        $session = \Config\Services::session();
        $data["session"] = $session;


        $model = new UserModel();
        $uList = $model->findAll();
        $data['users'] = $uList;

        // print view('Admin/adminView');
        print view('Admin/userList.php', $data);
    }


    public function deleteUser(){

        $data = [];

        try {

            $user = new UserModel;
            $userId = $this->request->getPost("uid");
            $thisUser = $user->find($userId);

                       

            if($thisUser['delStatus'] == "n"){
                $stat = array('delStatus' => "y");
                $user->update($userId, $stat);

            }else{
                $stat = array('delStatus' => "n");
                $user->update($userId, $stat);
            }

            $data['user'] = $thisUser;
            $data['status'] = "Updated Successfully...!";
            return $this->response->setJSON($data);

        } catch (\Exception $e) {

            die($e->getMessage());
            $data["status"]  = $e;
            echo json_encode($data);
        }
    }


    public function updateUser()
    {

        $data = [];

        $user = new UserModel;
        $uid = $this->request->getPost("uid");
        $update_data = [


            "name1" => $this->request->getPost("uname1"),
            "name2" => $this->request->getPost("uname2"),
            "email" => $this->request->getPost("uemail"),
            "userName" => $this->request->getPost("uuname"),
            "address" => $this->request->getPost("uadd"),
            "contact" => $this->request->getPost("ucontact"),
            "password" => $this->request->getPost("upass"),
            "userType" => $this->request->getPost("uType"),


        ];

        try {

            $user->update($uid, $update_data);

            $data["status"]  = 'data saved successfully';
            echo json_encode($data);
        } catch (\Exception $e) {

            die($e->getMessage());
            echo "<script>console.log('". json_encode($e)  . "' );</script>";
            $data["status"]  = $e;
            echo json_encode($data);
        }
    }

    public function getuser()
    {

        try {

            $user = new UserModel;
            $userId = $this->request->getPost("uid");
            $data['user'] = $user->find($userId);
            return $this->response->setJSON($data);
        } catch (\Exception $e) {

            die($e->getMessage());
            $data["status"]  = $e;
            echo json_encode($data);
        }
    }
    public function save()
    {

        $data = [];
        $user = new UserModel;
        $register_data = [

            "name1" => $this->request->getPost("uname1"),
            "name2" => $this->request->getPost("uname2"),
            "email" => $this->request->getPost("uemail"),
            "userName" => $this->request->getPost("uuname"),
            "address" => $this->request->getPost("uadd"),
            "contact" => $this->request->getPost("ucontact"),
            "password" => $this->request->getPost("upass"),
            "userType" => $this->request->getPost("uType"),
            "delStatus" => "n",
            "verify" => "n",

        ];

        try {

            $user->save($register_data);

            $data["status"]  = 'data saved successfully';
            echo json_encode($data);
        } catch (\Exception $e) {

            die($e->getMessage());
            $data["status"]  = $e;
            echo json_encode($data);
        }
    }




    public function list()
    {
        // $session = \Config\Services::session();
        // $data["session"] = $session; 


        // $userModel = new UserModel();
        // $data['users'] = $userModel->getRecords(); 
        // //return view('Admin/userList.php', $data);

        // return ($data);



    }
}
