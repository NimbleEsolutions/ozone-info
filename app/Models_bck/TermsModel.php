<?php namespace App\Models;

use CodeIgniter\Model;

class TermsModel extends Model 
{
    protected $table = 'sales_terms';
    protected $primaryKey = 'term_id';
    protected $allowedFields =['term_name','term_isDelete'];
}
