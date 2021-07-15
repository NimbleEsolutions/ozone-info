<?php namespace App\Models;

use CodeIgniter\Model;

class BideligibilityModel extends Model 
{
    protected $table = 'sales_bid_eligibility';
    protected $primaryKey = 'be_id';
    protected $allowedFields =['be_bid_id','be_eligibility_id','be_value','be_doc_required','be_doc_name','be_doc_url','be_createdBy','be_createdOn','be_isDelete'];
}
