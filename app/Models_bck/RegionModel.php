<?php namespace App\Models;

use CodeIgniter\Model;

class RegionModel extends Model 
{
    protected $table = 'sales_region';
    protected $primaryKey = 'reg_id';
    protected $allowedFields =['reg_name','reg_isDelete'];
}
