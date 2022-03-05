<?php

namespace App\Controllers;



use App\Models\UserModel;
use CodeIgniter\CLI\Console;
use CodeIgniter\Model;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;

require(APPPATH . "ThirdParty\PHPMailer\src\Exception.php");
require(APPPATH . "ThirdParty\PHPMailer\src\PHPMailer.php");
require(APPPATH . "ThirdParty\PHPMailer\src\SMTP.php");
require(APPPATH . "ThirdParty\PHPMailer\src\OAuth.php");


class Users extends BaseController
{

    function __construct()
    {
        // parent::__construct;
    }

    public function index()
    {
        $data = [];
        helper(['form']);
        $session = \Config\Services::session();

        if ($this->request->getMethod() == "post") {
            $validation =  \Config\Services::validation();

            $rules = [

                "uemail" => [
                    "label" => "Email",
                    "rules" => "required|valid_email"
                ],

                "upass" => [
                    "label" => "Password",
                    "rules" => "required|validateUser[upass]"
                ],

            ];

            $errors = [
                "upass" => [
                    "validateUser" => "Email or Password do not match"
                    
                ]

            ];

            if (!$this->validate($rules, $errors)) {

                $data["validation"] = $this->validator;
                // $session->setFlashdata('fail', $this->validator);

                // echo "<script>console.log('" . json_encode($data["validation"])  . "' );</script>";
            } else {
                
                $model = new UserModel();
                $user = $model->where("email", $this->request->getVar("uemail"))
                    ->first();
                    


                        if($user['verify'] == 'y'){
                            echo "<script>console.log('verified user' );</script>";
                            $this->setUserSession($user);
                            return redirect()->to('/home'); 
                        }else{

                            $data['user'] = $user;
                            echo "<script>console.log('unverified user' );</script>";
                            return view('Admin/verify',$data);
                            // return view('Admin/login',$data);
                        }                    

            }
        }


        echo view('Admin/login', $data);
    }

    public function verify(){

        $data = [];
        helper(['form']);
        $session = \Config\Services::session();
        
        echo view('Admin/verify');
    }

    public function verifyotp(){

        

        $userId = $this->request->getPost("id");
        $otp = $this->request->getPost("uver");
       

        $model = new UserModel();
        $user = $model->where("uid", $userId)
                    ->first();

            if($user['random_pw'] == $otp){

                $stat = array('verify' => "y");
                $model->update($userId, $stat);

            $data['status'] = "Your account is verified....";
            $this->setUserSession($user);
            $data['redir_url'] = '/home';
            return $this->response->setJSON($data);

            }else{
                $data['status'] = "Invalid OTP";
                return $this->response->setJSON($data);
            }


    }

    private function setUserSession($user)
    {


        $data = [

            'uid' => $user['uid'],
            'uemail' => $user['email'],
            'uname' => $user['name1'],
            'uType' => $user['userType'],
            'isLoggedIn' => true,



        ];

        session()->set($data);
        return true;
    }

    public function register()
    {

        $session = \Config\Services::session();
        helper(["form"]);
        $data = [];

        $register_data = [

            "name1" => $this->request->getVar("uname1"),
            "name2" => $this->request->getVar("uname2"),
            "email" => $this->request->getVar("uemail"),
            "userName" => $this->request->getVar("uuname"),
            "address" => $this->request->getVar("uadd"),
            "contact" => $this->request->getVar("ucontact"),
            "password" => $this->request->getVar("upass"),
            "userType" => "p",
            "delStatus" => "n",
            "verify" => "n",
            "random_pw" => rand(25756,97456)

        ];

        if ($this->request->getMethod() == "post") {
            $validation =  \Config\Services::validation();

            $rules = [

                "uname1" => [
                    "label" => "First Name",
                    "rules" => "required|min_length[3]|max_length[30]"
                ],
                "uname2" => [
                    "label" => "Last Name",
                    "rules" => "required|min_length[3]|max_length[30]"
                ],
                "uemail" => [
                    "label" => "Email",
                    "rules" => "required|min_length[6]|max_length[50]|valid_email|is_unique[user_details.email]"
                ],
                "uuname" => [
                    "label" => "User Name",
                    "rules" => "required|min_length[3]|max_length[10]|is_unique[user_details.userName]"
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


            if (!$this->validate($rules)) {

                $data["validation"] = $this->validator;
            } else {

                $user = new UserModel();
                $register_data = [

                    "name1" => $this->request->getVar("uname1"),
                    "name2" => $this->request->getVar("uname2"),
                    "email" => $this->request->getVar("uemail"),
                    "userName" => $this->request->getVar("uuname"),
                    "address" => $this->request->getVar("uadd"),
                    "contact" => $this->request->getVar("ucontact"),
                    "password" => $this->request->getVar("upass"),
                    "userType" => "p",
                    "delStatus" => "n",
                    "verify" => "n",
                    "random_pw" => rand(25756,97456)

                ];

                $user->save($register_data);
                $user_id = $user->getInsertID();
                // $this->sendEmail($register_data);

                $session = session();
                $data['regData'] = $register_data;

                $session->setFlashdata("success", "Registration successfull. Please check your inbox and verify the email address.");
                
                

                //  return redirect()->to('/');
                return view('Admin/login',$data);
            }
        }

        echo view('Admin/register', $data);
    }

    public function sendEmail($register_data)
    {
        echo "<script>console.log('sending email' );</script>";
        $to = $register_data['email'];
        $subject = 'City Taxi Registration Verification';
        $message = 'Hi,<br><br> Your registration is successfull with City Taxi. Please click below link to acivate your account<br><br>'
            . '<a href="' . base_url() . '/verify" target="_blank">Activate Now</a><br><br>Thanks<br><br>City Taxi Team';

        $email = \Config\Services::email();
        // $emailConfig = new \Config\Email();
        // $email->initialize($emailConfig);
        $email->setTo("citytaxi1212@gmail.com");
        $email->setFrom("citytaxi1212@gmail.com", "City Taxi");
        $email->setNewline("\r\n");
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {

            echo "<script>console.log('email sent' );</script>";
        } else {

            $data = $email->printDebugger(['headers']);
            print_r($data);
            echo "<script>console.log('" . json_encode($data)  . "' );</script>";
        }


        echo $this->email->print_debugger();
    }
}
