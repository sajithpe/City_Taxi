<?php

namespace App\Validation;

use App\Models\UserModel;

class UserRules {

    public function validateUser(string $str, string $fields, array $data){

        $model = new UserModel();
        $user = $model->where('email', $data['uemail'])
                      ->first();

        
        if(!$user){
            echo "<script>console.log('user false' );</script>";
            return false;
        }else{
            echo "<script>console.log('user true' );</script>";
            
            password_verify($data['upass'], $user['password']);
            
        }
           
                   
        
        

    }
}

?>