<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierApplicants extends Model
{   

    use SoftDeletes;

    protected $table = 'supplier_applicants';
    protected $guarded = [];

    protected $dates = ['approved_time', 'disapproved_time'];

    public function products()
    {
        return $this->hasMany('App\SupplierModels\SupplierApplicantProducts','applicant_id');
    }

    public function getHasaccountAttribute()
    {
        $user = \App\User::where('email', $this->email)->first();
		if ($user === null) {
		   return 0;
		}
		return 1;
    }

    public function getUserObjAttribute()
    {
        return \App\User::where('email', $this->email)->first();
    }

}
