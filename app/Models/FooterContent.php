<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;

class FooterContent extends BaseModel
{

    use HasFactory;
    protected $hidden = ['id','created_at', 'updated_at'];

    public function getAttribute($value)
    {
        $value = self::jsonDecode($value);
        return Voyager::image($value);
    }

    public function getYoutubeImageAttribute($value)
    {
        $value = self::jsonDecode($value);
        return Voyager::image($value);
    }

    public function getInstagramImageAttribute($value)
    {
        $value = self::jsonDecode($value);
        return Voyager::image($value);
    }

    public function getFacebookImageAttribute($value)
    {
        $value = self::jsonDecode($value);
        return Voyager::image($value);
    }
}
