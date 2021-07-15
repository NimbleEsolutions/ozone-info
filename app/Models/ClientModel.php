<?php namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table="sales_client";
    protected $primaryKey = 'client_id';
    protected $allowedFields = ['client_name','client_contact','client_other_contact','client_email','client_other_email','client_address','client_state','client_city','client_pincode','client_website','client_isDelete','client_createdBy','client_createdOn'];
}
