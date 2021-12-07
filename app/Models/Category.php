<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;

class Category extends BaseModel
{
    use HasFactory;

    public function products(){
        return $this->belongsToMany(Product::class,'category_products','category_id','product_id');
    }


    public function getImageAttribute($value)
    {
        if ($value != null){
            $value = self::jsonDecode($value);
            return Voyager::image($value);
        }
        return "";
    }
}

