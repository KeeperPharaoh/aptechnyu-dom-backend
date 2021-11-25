<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;

class Product extends Model
{
    use HasFactory;

    public function getImageAttribute($value)
    {
        return Voyager::image($value);
    }


    public function categories(){
        return $this->belongsToMany(Category::class,'category_products','product_id','category_id');
    }


    public function favorite()
    {
        return $this->hasMany(Favorite::class, 'product_id')->where('user_id', auth('sanctum')->user()->id);
    }
}
