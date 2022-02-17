<?php

namespace App\Controllers;


use App\Models\UserModel;
use CodeIgniter\CLI\Console;
use CodeIgniter\Model;


class Users extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);
        $session = \Config\Services::session();
        echo view('Admin/login', $data);
    }

    public function register(){
        echo "<script>console.log('hit register' );</script>";
       
        $session = \Config\Services::session();
        helper(["form"]);
        $data = [];

        $register_data=[

            "name1" => $this->request->getVar("uname1"),
            "name2" => $this->request->getVar("uname2"),
            "email" => $this->request->getVar("uemail"),
            "userName" => $this->request->getVar("uuname"),
            "address" => $this->request->getVar("uadd"),
            "contact" => $this->request->getVar("ucontact"),
            "password" => $this->request->getVar("upass"),
            "userType" => "p",
            "delStatus" => "n",

        ];

        echo "<script>console.log('". json_encode($register_data)  . "' );</script>";
        if ($this->request->getMethod() == "post") {
            $validation =  \Config\Services::validation();        
            echo "<script>console.log('hit post' );</script>";
            $rules = [
                
                "uname1" => [
                    "label" => "First Name",
                    "rules" => "required|min_length[3]|max_length[30]"
                ],
                "uname2" => [
                    "label" => "Last Name",
                    "rules" => "required|min_length[3]|max_length[30]"
                ],
                "uemail" =>[ 
                    "label" => "Email",
                    "rules" => "required|min_length[6]|max_length[50]|valid_email"
                ],
                "uuname" => [
                    "label" => "User Name",
                    "rules" => "required|min_length[3]|max_length[10]"
                ],
                "uadd" => [
                    "label" => "Address",
                    "rules" => "required|min_length[10]"
                ],
                "ucontact" => [
                    "label" => "Contact",
                    "rules" => "required|min_length[10]|max_length[10]"
                ],
                "upass" => [
                    "label" => "Password",
                    "rules" => "required|min_length[3]|max_length[20]"
                ],
                "upass2" => [
                    "label" => "Confirm Password",
                    "rules" => "matches[upass]"
                ],
            ];

            
            if(! $this->validate($rules)){
                              
                $data["validation"] = $this->validator;
                            

            }else{

                $user = new UserModel();
                $register_data=[

                    "name1" => $this->request->getVar("uname1"),
                    "name2" => $this->request->getVar("uname2"),
                    "email" => $this->request->getVar("uemail"),
                    "userName" => $this->request->getVar("uuname"),
                    "address" => $this->request->getVar("uadd"),
                    "contact" => $this->request->getVar("ucontact"),
                    "password" => $this->request->getVar("upass"),
                    "userType" => "p",
                    "delStatus" => "n",
        
                ];

                $user->save($register_data);
                
                 $session = session();
                 echo "<script>console.log('validation true' );</script>";
                 $session->setFlashdata("success","Registration successfull.");
                 return redirect()->to('/');
                


            }
        }
        echo "<script>console.log('outside' );</script>";
        echo view('Admin/register', $data);
    }

   
}
