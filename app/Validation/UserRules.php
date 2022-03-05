<?php

namespace App\Validation;

use App\Models\UserModel;

class UserRules {

    public function validateUser(string $str, string $fields, array $data){

        $model = new UserModel();
        $user = $model->where('email', $data['uemail'])
                      ->first();

        
        if(!$user){
            echo "<script>console.log('user rule false' );</script>";
            return false;
        }else{
            echo "<script>console.log('user rule true' );</script>";
            
            if($data['upass'] == $user['password']){
                echo "<script>console.log('pw match' );</script>";
                return true;
            }else{
                echo "<script>console.log('pw not match' );</script>";
                return false;
            }
            // password_verify($data['upass'], $user['password']);
            
        } 
        
    }

    public function validateOTP(string $str, string $fields, array $data){

        $model = new UserModel();
        $user = $model->where('email', $data['uemail'])
                      ->first();
            
    }
      
}

?>