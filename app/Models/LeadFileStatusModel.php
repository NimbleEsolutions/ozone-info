<?php namespace App\Models;

use CodeIgniter\Model;

class LeadFileStatusModel extends Model 
{
    protected $table = 'sales_lead_file_status';
    protected $primaryKey = 'lfs_id';
    protected $allowedFields =['lfs_lead_id','lfs_lead_status','lfs_update_date','lfs_update_by'];
}
