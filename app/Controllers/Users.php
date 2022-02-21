<?php
namespace App\Controllers;



use App\Models\UserModel;
use CodeIgniter\CLI\Console;
use CodeIgniter\Model;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;

require (APPPATH."ThirdParty\PHPMailer\src\Exception.php");
require (APPPATH."ThirdParty\PHPMailer\src\PHPMailer.php");
require (APPPATH."ThirdParty\PHPMailer\src\SMTP.php");
require (APPPATH."ThirdParty\PHPMailer\src\OAuth.php");


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
               
                "uemail" =>[ 
                    "label" => "Email",
                    "rules" => "required|valid_email"
                ],
               
                "upass" => [
                    "label" => "Password",
                    "rules" => "required|validateUser[uemail,upass]"
                ],
                
            ];

            $errors = [
                "upass" => [
                    "validateUser" => "Email or Password do not match"
                ]

            ] ;
            
            if(!$this->validate($rules, $errors)){
                   
                $data["validation"] = $this->validator;   
                echo "<script>console.log('". json_encode($data["validation"])  . "' );</script>";
               
            }else{
                echo "<script>console.log('all true' );</script>";
                $model = new UserModel();
                $user = $model->where("email",$this->request->getVar("uemail"))
                              ->first();

                $this->setUserSession($user);

                return redirect()->to('/home');
                
            }
        }


        echo view('Admin/login', $data);
    }

    private function setUserSession($user){

       
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

    public function register(){
       
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
                "uemail" =>[ 
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
                 $this->sendEmail($register_data);
                 $session->setFlashdata("success","Registration successfull. Please check your inbox and verify the email address.");
                 return redirect()->to('/');
                
            }
        }
      
        echo view('Admin/register', $data);
        //$this->sendEmail($register_data);
        //$this->send_phpMail();
    }

    public function sendEmail($register_data){
        echo "<script>console.log('sending email' );</script>";
        $to = $register_data['email'];
        $subject = 'City Taxi Registration Verification';
        $message = 'Hi,<br><br> Your registration is successfull with City Taxi. Please click below link to acivate your account<br><br>'
                    . '<a href="'.base_url().'/verify" target="_blank">Activate Now</a><br><br>Thanks<br><br>City Taxi Team';

        $email = \Config\Services::email();
        // $emailConfig = new \Config\Email();
        // $email->initialize($emailConfig);
        $email->setTo("citytaxi1212@gmail.com");
        $email->setFrom("citytaxi1212@gmail.com", "City Taxi");
        $email->setNewline("\r\n");
        $email->setSubject($subject);
        $email->setMessage($message);

        if($email->send()){

            echo "<script>console.log('email sent' );</script>";
        }else{

            $data = $email->printDebugger(['headers']);
            print_r($data);
            echo "<script>console.log('". json_encode($data)  . "' );</script>";
        }


            //Load email library
            // $this->load->library('email');

        // $config = Array(
        //     'protocol' => 'SMTP',
        //     'smtp_host' => 'ssl://smtp.googlemail.com',
        //     'smtp_port' => 465,
        //     'smtp_user' => 'citytaxi1212@gmail.com',
        //     'smtp_pass' => 'City@taxi123',
        //     'mailtype'  => 'html',
        //     'charset'   => 'iso-8859-1'
        // );
        
        // $this->email->initialize($config);
        // $this->email->set_mailtype("html");
        // $this->email->set_newline("\r\n");

        
        // $this->email->from('citytaxi1212@gmail.com','City Taxi');
        // $this->email->to('sajithperera90@gmail.com');
        // $this->email->subject($subject);
        // $this->email->message($message);
        // $this->email->send();

        // if($this->email->send()){
        //     echo "<script>console.log('email sent' );</script>";
            
        // }
        // else{
        //     $data = $this->email->printDebugger(['headers']);
        //     echo "<script>console.log('". json_encode($data)  . "' );</script>";
        // }

        echo $this->email->print_debugger();
        
    }


    public function send_phpMail(){

        $subject = 'City Taxi Registration Verification';
        $message = 'Hi,<br><br> Your registration is successfull with City Taxi. Please click below link to acivate your account<br><br>'
                    . '<a href="'.base_url().'/verify" target="_blank">Activate Now</a><br><br>Thanks<br><br>City Taxi Team';


        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->SMTPDebug = 2;
            $mail->SMTPAuth = True;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->Host = 'smtp.gmail.com';
            $mail->Username = 'citytaxi1212@gmail.com';
            $mail->Password = 'City@taxi123';
            $mail->isHTML(True);  
            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
                );
            
            $mail->setFrom('citytaxi1212@gmail.com','City Taxi');
            $mail->addReplyTo('citytaxi1212@gmail.com','City Taxi');
            $mail->addAddress('sajithperera90@gmail.com');
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AltBody = $message;

            if(!$mail->send()){
                echo $mail->ErrorInfo;
            }else{
                echo 'Done';
            }
        } catch (Exception $e) {
            echo $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Boring error messages from anything else!
        }

        // $this->load->library('PHPMailer_Lib');
        
        // $mail->ClearAddresses();
        // $mail->ClearAttachments();
        // $mail->isSMTP();
        // $mail->Host = 'smtp.gmail.com';
        // $mail->SMTPAuth = true;
        // $mail->Username = 'citytaxi1212@gmail.com';
        // $mail->Password = 'City@taxi123';
        // $mail->SMTPSecure = 'ssl';
        // $mail->Port = 465;

        // $mail->setFrom('citytaxi1212@gmail.com','City Taxi');
        // $mail->addReplyTo('citytaxi1212@gmail.com','City Taxi');
        // $mail->addAddress('sajithperera90@gmail.com');
        // $mail->Subject = 'City Taxi Registration';

        // $mail->isHTML(true);
        // $mail->Body = $message;
        


    }

   
}
