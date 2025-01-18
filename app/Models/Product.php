<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }


    // public function getFirstImageAttribute()
    // {
    //     $firstImage = $this->productImages()->first();
    //     return $firstImage ? $firstImage->image : null; // Assuming 'url' is the attribute where the image URL is stored
    // }

    public function getImageAttribute($value)
    {

        // if ($value) {
        //     return asset('uploads/products/' . $value); //123.jpg
        // }

        // return url('uploads/noImage.jpg');
        $firstImage = $this->productImages()->first();
        return $firstImage ? $firstImage->image : null;
    }

    public function getDiscountAttribute($value){

        $type = $this->discount_type;
        $price = $this->price;
        $discount_value = $value;
        $qty = 1;


        $discount = [];

        if ($type == 'percentage') {
            $discount['amount'] = ((float)($price * $discount_value / 100)) * $qty;
            $discount['percentage'] = $discount_value . "%";
        } else {
            $discount['amount'] = $discount_value * $qty;
            $discount['percentage'] = $discount_value ? (round($discount_value * 100 / $price, 1) . "%") : "0%";
        }
       return $discount;
    }

    public function getPriceAttribute($value){
        return round($value);
    }

    public function review_rating(){
        return $this->hasMany(ReviewRating::class, 'product_id', 'id');
    }
    protected $appends = ['rate'];

    public function getRateAttribute()
    {
        $reviews = $this->review_rating;
        if ($reviews === null || $reviews->isEmpty()) {
            return 0; 
        }
    
        $totalRating = $reviews->sum('rating');
        $totalReviews = $reviews->count();
        $averageRating = $totalReviews > 0 ? round($totalRating / $totalReviews) : 0;
    
        return $averageRating;
    }

    
}
