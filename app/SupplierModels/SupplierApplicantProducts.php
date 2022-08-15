<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;

class SupplierApplicantProducts extends Model
{
    protected $table = 'supplier_applicant_products';
    protected $fillable = ['url', 'name', 'description', 'file_url','applicant_id'];
}
