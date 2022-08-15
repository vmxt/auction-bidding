<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierFinancialStatus extends Model
{

    protected $table = 'supplier_financial_status';

    protected $guarded = [];


    public function supplier () 
    {
        return $this->belongsTo('App\User');
    }
    
}
