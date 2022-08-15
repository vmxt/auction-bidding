<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $table = 'users';
 	
 	public function getFullNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    public function getSupplierStatusAttribute()
    {
        if($this->supplier_status == 1)
            return 'Applicant';
        if($this->supplier_status == 2)
            return 'Accredited';
        else
            return '';
    }

    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }

    // Relationships

    public function supplier_details () 
    {
        return $this->hasOne('App\SupplierModels\SupplierDetails', 'supplier_id');
    }

    public function supplier_officers () 
    {
        return $this->hasMany('App\SupplierModels\SupplierOfficers', 'supplier_id');
    }

    public function supplier_banks ()    
    {
        return $this->hasMany('App\SupplierModels\SupplierBankDetails', 'supplier_id');
    }

    public function supplier_credits () 
    {
        return $this->hasMany('App\SupplierModels\SupplierCredits', 'supplier_id');
    }
    
    public function supplier_services () 
    {
        return $this->hasMany('App\SupplierModels\SupplierServices', 'supplier_id');
    }
    
    public function supplier_requirements()
    {
        return $this->hasMany('App\SupplierModels\SupplierRequirements', 'supplier_id');
    }

    public function supplier_certifications () 
    {
        return $this->hasMany('App\SupplierModels\SupplierCertifications', 'supplier_id');
    }

    public function supplier_customers () 
    {
        return $this->hasMany('App\SupplierModels\SupplierCustomers', 'supplier_id');
    }
    
    public function supplier_contacts () 
    {
        return $this->hasMany('App\SupplierModels\SupplierContactDetails', 'supplier_id');
    }
    
    public function supplier_financial_status()
    {
        return $this->hasMany('App\SupplierModels\SupplierFinancialStatus', 'supplier_id');
    }   
}
