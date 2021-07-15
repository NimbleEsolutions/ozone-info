<?php namespace App\Models;

use CodeIgniter\Model;

class BidTermsModel extends Model 
{
    protected $table = 'sales_bid_terms';
    protected $primaryKey = 'bt_id';
    protected $allowedFields =['bt_bid_id','bt_term_id','bt_value','bt_doc_required','bt_doc_remark','bt_doc_url','bt_createdBy','bt_createdOn','bt_isDelete'];
}
