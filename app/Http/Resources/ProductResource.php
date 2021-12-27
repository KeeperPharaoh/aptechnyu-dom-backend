<?php

namespace App\Http\Resources;

use App\Models\Favorite;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ProductResource extends JsonResource
{

    public function toArray($request): array
    {
        if ($this->remainder > 0){
            $stock = true;
        }else{
            $stock = false;
        }
        return [
            'id'            =>  $this->id,
            'category_id'   =>  $this->subcategory_id,
            'title'         =>  $this->title,
            'subtitle'      =>  $this->subtitle,
            'article'       =>  $this->article,
            'image'         => env('APP_URL') . '/storage/' . $this->image,
            'price'         =>  $this->price,
            'old_price'     =>  $this->old_price,
            'stock'         =>  $stock,
            'country'       =>  $this->country,
            'manufacturer'  =>  $this->manufacturer,
            'instruction'   =>  $this->instruction,
            'composition'   =>  $this->composition,
            'description'   =>  $this->description,
            'is_favorite'   => $this->isFavorite($this->id),
        ];
    }

    public function isFavorite($id): bool
    {
        if (Auth::guard('sanctum')->check()){
            $status = Favorite::where('product_id', $id)
                ->where('user_id',Auth::guard('sanctum')->id())
                ->first();
            return !empty($status);
        }
        return false;
    }

}
