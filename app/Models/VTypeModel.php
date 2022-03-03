<?php

namespace App\Models;

use CodeIgniter\Model;

class VTypeModel extends Model
{
    protected $table            = 'vehicle_master_data';
    protected $primaryKey       = 'vm_id';
    protected $allowedFields    = ['v_type','cost_km','fuel_type','driver_pay','delStatus'];
}
