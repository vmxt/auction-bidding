<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierCertifications extends Model
{

    protected $table = 'supplier_certifications';

    protected $guarded = [];
    
    protected $dates = ['certification_validity'];
    
    public function supplier () 
    {
    	return $this->belongsTo('App\User');
    }

    public function setCertificationValidityAttribute($value)
    {
        $this->attributes['certification_validity'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
    }

}
