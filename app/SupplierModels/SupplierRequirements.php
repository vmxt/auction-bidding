<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierRequirements extends Model
{

    protected $table = 'supplier_requirements';

    protected $guarded = [];

    protected $dates = ['validity'];


    public function supplier () 
    {
    	return $this->belongsTo('App\User');
    }
    
}
