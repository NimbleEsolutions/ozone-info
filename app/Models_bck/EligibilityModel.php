<?php namespace App\Models;

use CodeIgniter\Model;

class EligibilityModel extends Model 
{
    protected $table = 'sales_eligibility';
    protected $primaryKey = 'el_id';
    protected $allowedFields =['el_name','el_isDelete'];
}
