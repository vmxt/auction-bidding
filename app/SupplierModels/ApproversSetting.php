<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;

class ApproversSetting extends Model
{
    protected $table = 'approvers_setting';
 	protected $guarded = [];
 	
 	public function approver()
    {
        return $this->belongsTo('App\User');
    }

}
