<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierServices extends Model
{

    protected $table = 'supplier_services';

    protected $guarded = [];


    public function supplier () 
    {
    	return $this->belongsTo('App\User');
    }
    
}
