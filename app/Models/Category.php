<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getImageAttribute($value)
     {
         if($value){
             return asset('uploads/category/'.$value);
         }
         return asset('uploads/noImage.jpg');
     }

    public function parent()
     {
        return $this->belongsTo(Category::class,'parent_id','id');
     }

    public function childs()
    {
        return $this->hasMany(Category::class,'parent_id')->with('parent');
    }
}
