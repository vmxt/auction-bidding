<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'region',
        'city',
        'full_address',
        'landline',
        'mobile_number',
        'email_address',
        'contact_person',
        'status'
    ];
}
