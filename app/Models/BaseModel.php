<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory;

    public static function jsonDecode($json){
        $json = json_decode($json, true);
        return 'storage/' .$json[0]['download_link'];
    }
}
