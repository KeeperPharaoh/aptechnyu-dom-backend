<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use function PHPUnit\Framework\isEmpty;

class CategoryCollection extends BaseCollection
{

    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            if (empty($item->image)){
                return [
                    'id'        => $item->id,
                    'title'     => $item->title,
                    'image'     => null,

                ];
            }
            return [
                'id'        => $item->id,
                'title'     => $item->title,
                'image'     => env('APP_URL') . '/storage/' . self::jsonDecode($item->image),

            ];
        });
    }
}
