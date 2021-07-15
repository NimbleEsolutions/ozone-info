<?php namespace App\Models;

use CodeIgniter\Model;

class BidProductModel extends Model 
{
    protected $table = 'sales_bid_products';
    protected $primaryKey = 'bidprod_id ';
    protected $allowedFields =['bidprod_bid_id','bidprod_product_id','bidprod_qty','bidprod_spcification','bidprod_mm','bidprod_budget','bidprod_gem','bidprod_tprice','bidprod_qprice','bidprod_lock','bidprod_mail','bidprod_remark','bidprod_status','bidprod_createdOn'];
}
