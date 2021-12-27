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
        'pivot',
        'remainder'
    ];

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /** @noinspection PhpUndefinedFieldInspection */
    public function favorite(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Favorite::class, 'product_id')->where('user_id', auth('sanctum')->user()->id);
    }
}
