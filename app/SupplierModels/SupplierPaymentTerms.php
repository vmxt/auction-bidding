<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;

class SupplierPaymentTerms extends Model
{

    protected $table = 'supplier_payment_terms';
    
    protected $guarded = [];


    public function supplier () 
    {
    	return $this->belongsTo('App\User');
    }


}
