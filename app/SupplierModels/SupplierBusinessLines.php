<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;

class SupplierBusinessLines extends Model
{

    protected $table = 'supplier_business_lines';
 	protected $guarded = [];
 	

 	public function user() {
 		return $this->belongsTo('App\User', 'supplier_id');
 	}


}
