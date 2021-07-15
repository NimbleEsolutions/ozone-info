<?php namespace App\Models;

use CodeIgniter\Model;

class FileUploadModel extends Model 
{
    protected $table = 'sales_upload';
    protected $primaryKey = 'up_id';
    protected $allowedFields =['up_type','up_type_id','up_url','up_isDelete','up_createdBy','up_createdOn'];
}
