<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title'         =>  $this->title,
            'subtitle'      =>  $this->subtitle,
            'article'       =>  $this->article,
            'image'         =>  $this->image,
            'price'         =>  $this->price,
            'old_price'     =>  $this->old_price,
            'stock'         =>  $this->stock,
            'country'       =>  $this->country,
            'manufacturer'  =>  $this->manufacturer,
            'instruction'   =>  $this->instruction,
            'description'   =>  $this->description,
        ];
    }
}
