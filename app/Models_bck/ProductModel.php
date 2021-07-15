<?php namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model 
{
    protected $table = 'sales_product';
    protected $primaryKey = 'product_id';
    protected $allowedFields =['product_name','product_isDelete','product_cat'];
}
