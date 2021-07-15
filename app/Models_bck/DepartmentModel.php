<?php namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model 
{
    protected $table = 'sales_department';
    protected $primaryKey = 'dept_id';
    protected $allowedFields =['dept_name','dept_isDelete'];
}
