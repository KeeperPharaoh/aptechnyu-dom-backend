<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
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
            'id'            => $item->id,
            'category_id'   => $item->category_id,
            'title'         => $item->title,
            'subtitle'      => $item->subtitle,
            'description'   => $item->description,
            'image'         => env('APP_URL') . '/storage/' . $item->image
            ];
        });
    }
}
