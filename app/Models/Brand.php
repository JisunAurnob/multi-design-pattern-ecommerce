<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
     public function getImageAttribute($value): string|UrlGenerator|Application
     {
         if($value){
             return asset('uploads/brand/'.$value);
         }
         return url('uploads/noImage.jpg');
     }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
