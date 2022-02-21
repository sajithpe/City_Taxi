<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PHPMailer_Lib 
{
	function __construct($config = array())
	{
        log_message('Debug','PHPMailer is loaded');
	}

	public function load()
    {
        require_once(APPPATH."third_party/PHPMailer/src/Exception.php");
        require_once(APPPATH."third_party/PHPMailer/src/PHPMailer.php");
        require_once(APPPATH."third_party/PHPMailer/src/SMTP.php");

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = True;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->Host = 'smtp.googlemail.com';
        $mail->Username = 'citytaxi1212@gmail.com';
        $mail->Password = 'City@taxi123';
        $mail->isHTML(True);  
        return $mail;
    }
}
