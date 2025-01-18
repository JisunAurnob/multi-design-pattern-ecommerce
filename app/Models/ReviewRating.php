<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewRating extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function order_details(){
        return $this->belongsTo(OrderDetails::class, 'order_details_id', 'id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
