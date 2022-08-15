<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApproverTemplates extends Model
{
 	use SoftDeletes;

    protected $table = 'approver_templates';
 	protected $guarded = [];

    
 	public function approver()
    {
        return $this->hasOne('App\User', 'approver_id');
    }


    public function user() {
    	return $this->belongsTo('App\User', 'approver_id');
    }

}
