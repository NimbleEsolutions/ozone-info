<?php namespace App\Models;

use CodeIgniter\Model;

class BidModel extends Model 
{
    protected $table = 'sales_bid';
    protected $primaryKey = 'bid_id';
    protected $allowedFields =['bid_lead_ref','bid_type','bid_openDate','bid_endDate','bid_validity','bid_region','bid_client','bid_dept','bid_contact_person','bid_emd_val','bid_emd','bid_epbg_val','bid_epbg','bid_participation','bid_createdOn','bid_createdBy','bid_isDelete','bid_status'];
}
