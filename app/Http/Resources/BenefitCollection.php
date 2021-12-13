<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BenefitCollection extends BaseCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                'title'     =>  $item->title,
                'subtitle'  =>  $item->subtitle,
                'image'     => env('APP_URL') . '/storage/' . self::jsonDecode($item->image)
            ];
        });
    }
}
