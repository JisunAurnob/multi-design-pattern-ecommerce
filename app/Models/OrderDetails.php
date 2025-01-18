<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function review_rating()
    {
        return $this->hasOne(ReviewRating::class, 'order_details_id', 'id');
    }
}
