<?php

namespace Cp\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    public function productSubcategories()
    {
        return $this->hasMany(ProductSubCategory::class);
    }

    public function activeSubCats()
    {
        return $this->hasMany(ProductSubCategory::class)->whereActive(true);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_cats');
    }

    public function fi()
    {
        return $this->image ?: 'not_found.jpg';
    }
}
