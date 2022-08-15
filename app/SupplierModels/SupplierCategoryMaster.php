<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierCategoryMaster extends Model
{
    use SoftDeletes;

    protected $table = 'supplier_category_master';
    protected $fillable = ['name', 'description', 'parent_id'];

   	public function parent()
    {
        return $this->belongsTo('App\SupplierModels\SupplierCategoryMaster','parent_id')
        ->withDefault([
        	'name' => '',
        ]);
    }
}
