<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryProductsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                'id'        => $item->id,
                'title'     => $item->title,
                'subtitle'  => $item->subtitle,
                'image'     => 'storage/' . $item->image,
                'article'   => $item->article,
                'price'     => $item->price,
                'old_price' => $item->old_price
            ];
        });
    }
}
