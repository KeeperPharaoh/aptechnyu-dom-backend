<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseCollection extends ResourceCollection
{
    public static function jsonDecode($json){
        $json = json_decode($json, true);
        if (empty($json)){
            return true;
        }
        return $json[0]['download_link'];
    }
}
