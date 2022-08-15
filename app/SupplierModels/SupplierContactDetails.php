<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierContactDetails extends Model
{

    protected $table = 'supplier_contact_details';
    
    protected $guarded = [];


    public function supplier() {
    	$this->belongsTo('App\User');
    }


}
