<?php

namespace App\Models;

use CodeIgniter\Model;

class VehicleModel extends Model
{
   
    protected $table            = 'vehicles';
    protected $primaryKey       = 'v_id';
    protected $allowedFields    = ['v_number','v_model','v_brand','v_delStatus','vm_id','uid'];

   
}
