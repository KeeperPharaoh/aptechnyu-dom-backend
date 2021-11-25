<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {
        if ($this->stock == 1){
            $stock = true;
        }else{
            $stock = false;
        }
        return [
            'title'         =>  $this->title,
            'subtitle'      =>  $this->subtitle,
            'article'       =>  $this->article,
            'image'         =>  $this->image,
            'price'         =>  $this->price,
            'old_price'     =>  $this->old_price,
            'stock'         =>  $stock,
            'country'       =>  $this->country,
            'manufacturer'  =>  $this->manufacturer,
            'instruction'   =>  $this->instruction,
            'composition'   =>  $this->composition,
            'description'   =>  $this->description,
        ];
    }
}
