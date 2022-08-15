<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;

class ApprovalHistory extends Model
{
    protected $table = 'approval_history';
 	protected $guarded = [];
 	
 	public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function step()
    {
        return $this->hasOne('App\SupplierModels\ApprovalSteps', 'approval_step_id');
    }

   
    
}
