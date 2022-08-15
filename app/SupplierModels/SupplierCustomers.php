<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierCustomers extends Model
{

    protected $table = 'supplier_customers';

    protected $guarded = [];
    

    public function supplier () 
    {
    	return $this->belongsTo('App\User');
    }
    
}
