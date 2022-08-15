<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierOfficers extends Model
{
    protected $table = 'supplier_officers';

    protected $guarded = [];



    public function supplier () 
    {
    	return $this->belongsTo('App\User');
    }
    
    
}
