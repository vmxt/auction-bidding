<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;

class ApproverSteps extends Model
{
    protected $table = 'approval_steps';
 	protected $guarded = [];
 	
    protected $dates = ['date_started'];

 	public function approver()
    {
        return $this->hasOne('App\User', 'approver_id');
    }

    public function approval()
    {
        return $this->belongsTo('App\SupplierModels\Approvals', 'approval_id');
    }


    public function getOverrideAttribute()
    {
        if(is_null($this->overridable))
            return [];

        return explode(",", $this->overridable);
    }

    public function canOverride($sequence) {
        
        if(in_array($sequence, $this->override) ) return true;

        return false;
    }

    public static function isCurrentApprover($supplier,$user){
    	$approval = \App\SupplierModels\Approvals::where('supplier_id',$supplier->id)->whereStatus('Active')->first();
    	if($approval){
    		$rs = \App\SupplierModels\ApproverSteps::where('approver_id', \Auth::id())->where('approval_id',$approval->id)->where('is_current',1)->first();
    		if($rs)
    			return true;
    		else
    			return false;
    	}
    	else{
    		return false;
    	}
    }

    public static function CurrentApprover($supplier){
        $approval = \App\SupplierModels\Approvals::where('supplier_id',$supplier->id)->whereStatus('Active')->first();
        if($approval){
            $rs = \App\SupplierModels\ApproverSteps::where('approval_id',$approval->id)->where('is_current',1)->first();
            return $rs;
        }
        else{
            return false;
        }
    }
    
}
