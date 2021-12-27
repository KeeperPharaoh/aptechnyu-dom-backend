<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use TCG\Voyager\Facades\Voyager;

class Category extends BaseModel
{
    use HasFactory;

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id','id');
    }

    public function products(): HasManyThrough
    {
        return $this->hasManyThrough(Product::class, Category::class, 'parent_id', 'subcategory_id', 'id');
    }
}

