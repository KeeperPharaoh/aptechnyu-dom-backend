<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CartCollection extends BaseCollection
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
                'id'           => $item->id,
                'quantity'     => $item->quantity,
                'title'        => $item->title,
                'subtitle'     => $item->subtitle,
                'image'        => env('APP_URL') . '/storage/' . $item->image,
                'price'        => $item->price,
                'old_price'    => $item->old_price,
            ];
        });
    }
}
