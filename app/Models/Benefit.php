<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;

class Benefit extends BaseModel
{
    use HasFactory;

    public function getImageAttribute($value)
    {
        $value = self::jsonDecode($value);
        return Voyager::image($value);
    }


    protected $hidden = ['id','created_at', 'updated_at'];
}
