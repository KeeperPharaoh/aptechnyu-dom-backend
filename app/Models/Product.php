<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;

class Product extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'order',
        'pivot'
    ];

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class,'category_products','product_id','category_id');
    }
    public function favorite(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Favorite::class, 'product_id')->where('user_id', auth('sanctum')->user()->id);
    }
}
