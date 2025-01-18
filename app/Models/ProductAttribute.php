<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product_images()
    {
        return $this->hasMany(ProductsImage::class, 'product_attribute_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
