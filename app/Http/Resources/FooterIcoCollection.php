<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FooterIcoCollection extends BaseCollection
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
                'image' => env('APP_URL') . '/storage/' . self::jsonDecode($item->image),
                'link'  =>  $item->link
            ];
        });
    }
}
