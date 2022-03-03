<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user_details';
    protected $primaryKey = 'uid';
    protected $allowedFields = ['name1', 'name2', 'address', 'userName', 'contact', 'email', 'userType', 'password','delStatus', 'verify'];
}
