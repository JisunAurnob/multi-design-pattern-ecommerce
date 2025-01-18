<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getImageAttribute($value)
    {
        // return $images=[
        //     'large'=>asset('/frontend/images/product_images/large/'.$value),
        //     'medium'=>asset('/frontend/images/product_images/medium/'.$value),
        //     'small'=>asset('/frontend/images/product_images/small/'.$value),
        // ];
        return asset('/uploads/products/'.$value);
    }
}
