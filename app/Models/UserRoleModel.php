<?php namespace App\Models;

use CodeIgniter\Model;

class UserRoleModel extends Model 
{
    protected $table = 'sales_user_role';
    protected $primaryKey = 'role_id';
    protected $allowedFields =['role_name','role_isValid'];
}
