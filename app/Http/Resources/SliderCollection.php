<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SliderCollection extends ResourceCollection
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
            'old_price' =>  $item->old_price,
            'price'     =>  $item->price,
            'button'    =>  $item->button,
            'link'      =>  $item->link,
            'image'     => env('APP_URL') . '/storage/' . $item->image
            ];
        });
    }
}
