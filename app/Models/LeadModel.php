<?php namespace App\Models;

use CodeIgniter\Model;

class LeadModel extends Model
{
    protected $table="sales_lead";
    protected $primaryKey = 'lead_id';
    protected $allowedFields = ['lead_generated_date','lead_client','lead_dept','lead_contact_person','lead_due_date','lead_budget','lead_region','lead_procurement_type','lead_file_status','lead_status','lead_participation_status','lead_participation_remark','lead_isDelete','lead_createdBy','lead_createdOn'];
}
