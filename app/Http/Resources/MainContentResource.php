<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MainContentResource extends JsonResource
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
            'title'         => $this->title,
            'subtitle'      => $this->subtitle,
            'image'         => env('APP_URL') . '/storage/' . $this->image,
            'description'   => $this->description,
            'paragraph'     => $this->paragraph
        ];
    }
}
