<?php

namespace Cp\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'addedby_id');
    }

    public function productCategories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_cats');
    }

    public function productSubcategories()
    {
        return $this->belongsToMany(ProductSubCategory::class, 'product_subcats', Null, 'product_subcategory_id');
    }

    public function files()
    {
        return $this->hasMany(ProductFile::class)->orderBy('id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }


    public function activeProductImages()
    {
        return $this->productImages()->whereActive(true)->get();
    }



    public function fi()
    {
        return $this->featured_image ?: 'product.png';
    }
}
