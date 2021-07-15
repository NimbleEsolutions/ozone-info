<?php namespace App\Models;

use CodeIgniter\Model;

class DataCallModel extends Model 
{
    protected $table = 'sales_lead_data_call';
    protected $primaryKey = 'dc_id';
    protected $allowedFields =['dc_lead_id','dc_date','dc_action','dc_remark','dc_isDelete','dc_createdBy','dc_createdOn'];
}
