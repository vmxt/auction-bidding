<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;

class SupplierTempUpdate extends Model
{
    
    protected $table = 'supplier_temp_updates';
 	protected $guarded = [];
 	
 	public function supplier()
    {
        return $this->belongsTo('App\User', 'supplier_id');
    }

    public function supplier_details()
    {
        return $this->belongsTo('App\SupplierModels\SupplierDetails', 'supplier_id','supplier_id');
    }
    

}
