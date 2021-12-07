<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;

class IconFooter extends BaseModel
{
    use HasFactory;
    protected $hidden = ['id','created_at', 'updated_at'];

    public function getImageAttribute($value)
    {
        if ($value != null){
            $value = self::jsonDecode($value);
            return Voyager::image($value);
        }
        return true;
    }

}
