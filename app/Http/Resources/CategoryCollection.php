<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends BaseCollection
{

    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                'id'        => $item->id,
                'title'     => $item->title,
                'image'     => env('APP_URL') . '/storage/' . self::jsonDecode($item->image),

            ];
        });
    }
}
