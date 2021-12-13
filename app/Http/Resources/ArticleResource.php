<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'category_id'   => $this->category_id,
            'title'         => $this->title,
            'subtitle'      => $this->subtitle,
            'description'   => $this->description,
            'image'         => env('APP_URL') . '/storage/' . $this->image
        ];
    }
}
