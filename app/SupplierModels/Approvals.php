<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;

class Approvals extends Model
{
    protected $table = 'approvals';
 	protected $guarded = [];
 	
 	public function supplier()
    {
        return $this->belongsTo('App\User', 'supplier_id');
    }

    public function supplier_details()
    {
        return $this->belongsTo('App\SupplierModels\SupplierDetails', 'supplier_id','supplier_id');
    }
    
    public function approver_steps()
    {
    	return $this->hasMany('App\SupplierModels\ApproverSteps');
    }

}
