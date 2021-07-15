<?php namespace App\Models;

use CodeIgniter\Model;

class BidTypeModel extends Model 
{
    protected $table = 'sales_bid_type';
    protected $primaryKey = 'btype_id';
    protected $allowedFields =['btype_name','btype_isDelete'];
}
