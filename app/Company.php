<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Branch;
use App\User;

class Company extends Model
{
    protected $fillable = [
        'name',
        'office_address',
        'contact_person',
        'contact_number',
        'mobile_number',
        'email_address',
        'status'
    ];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
