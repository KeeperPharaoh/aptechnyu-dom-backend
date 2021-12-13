<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlockResource extends JsonResource
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
            'title'     => $this->title,
            'subtitle'  => $this->subtitle,
            'image'         => env('APP_URL') . '/storage/' . $this->image,
            'button'    => $this->button,
            'link'      => $this->link
        ];
    }
}
