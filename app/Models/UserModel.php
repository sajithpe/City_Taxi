<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user_details';
    protected $allowedFields = ['user_name', 'user_email', 'user_password', 'user_created_at'];
}
