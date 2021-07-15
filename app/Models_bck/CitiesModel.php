<?php namespace App\Models;

use CodeIgniter\Model;

class CitiesModel extends Model 
{
    protected $table = 'sales_cities';
    protected $primaryKey = 'ct_id';
    protected $allowedFields =['ct_name','st_id'];
}
