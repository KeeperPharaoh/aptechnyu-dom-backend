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
}

