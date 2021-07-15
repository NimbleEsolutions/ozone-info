<?php namespace App\Models;

use CodeIgniter\Model;

class LeadRequirementModel extends Model
{
    protected $table="sales_lead_requirement";
    protected $primaryKey = 'lr_id';
    protected $allowedFields = ['lr_lead_id','lr_product_id','lr_quantity','lr_proposed_product','lr_product_specification','lr_product_gem_link','lr_isDelete'];
}
