<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierDetails extends Model
{
    use SoftDeletes;

    protected $table = 'supplier_details';
    
    protected $guarded = [];

    private $errors;

    protected $rules = [
        'company_name' 			=> 'required' ,
        'tin'					=> 'required' ,
        'date_establieshed'		=> 'required' ,
        'business_type'			=> 'required' ,
        'organization_type'		=> 'required'
    ];



    public function validate($data) {

    	$v = Validator::make($data, $this->rules);

        if ($v->fails())
        {
            $this->errors = $v->errors;
            return false;
        }

        return true;

    }

    public function errors()
    {
        return $this->errors;
    }


    public function supplier () 
    {
        return $this->belongsTo('App\User');
    }

    public function getAddressAttribute () 
    {

        $address = "";

        if(!is_null($this->unit) && $this->unit != "") 
            $address .= $this->unit .", ";

        if(!is_null($this->block) && $this->block != "") 
            $address .= $this->block .", ";

        if(!is_null($this->street) && $this->street != "") 
            $address .= $this->street .", ";

        if(!is_null($this->barangay) && $this->barangay != "") 
            $address .= $this->barangay .", ";

        if(!is_null($this->city) && $this->city != "") 
            $address .= $this->city .", ";

        if(!is_null($this->province) && $this->province != "") 
            $address .= $this->province .", ";

        if(!is_null($this->country) && $this->country != "") 
            $address .= $this->country;

        if(!is_null($this->zip) && $this->zip != "") 
            $address .= ", ". $this->zip;

        return $address;

    }

    





}
