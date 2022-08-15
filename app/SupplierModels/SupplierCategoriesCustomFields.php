<?php

namespace App\SupplierModels;

use Illuminate\Database\Eloquent\Model;

class SupplierCategoriesCustomFields extends Model
{
    use SoftDeletes;

    protected $table = 'supplier_categories_custom_fields';
    protected $fillable = ['category_id', 'name', 'description', 'is_required', 'is_attachment_required'];

}
