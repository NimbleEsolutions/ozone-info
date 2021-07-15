<?php namespace App\Models;

use CodeIgniter\Model;

class ContactPersonModel extends Model
{
    protected $table = 'sales_contact_person';
    protected $primaryKey = 'cp_id';
    protected $allowedFields = ['cp_first_name','cp_middle_name','cp_last_name','cp_mobile','cp_other_contact','cp_email','cp_other_email','cp_department','cp_company','cp_contact_for','cp_isDelete','cp_createdBy','cp_createdOn'];
}