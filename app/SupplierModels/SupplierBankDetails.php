<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierBankDetails extends Model
{

    protected $table = 'supplier_bank_details';
    
    protected $guarded = [];


    public function supplier () 
    {
    	return $this->belongsTo('App\User');
    }


}
