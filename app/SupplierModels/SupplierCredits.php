<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierCredits extends Model
{

    protected $table = 'supplier_credits';

    protected $guarded = [];
    
    
    public function supplier () 
    {
        return $this->belongsTo('App\User');
    }


}
