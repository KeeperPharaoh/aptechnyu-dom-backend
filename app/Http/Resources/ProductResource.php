<?php

namespace App\Http\Resources;

use App\Models\CategoryProducts;
use App\Models\Favorite;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {
        if ($this->stock == 1){
            $stock = true;
        }else{
            $stock = false;
        }
        $category_id = self::findCategory($this->id);
        return [
            'category_id'   =>  $category_id,
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
            'is_favorite'   => $this->isFavorite($this->id),
            'is_selected'   => false
        ];
    }

    public static function findCategory($id)
    {
        $prod = CategoryProducts::all()
            ->where('product_id',$id)
            ->where('category_id','!=',8)
            ->where('category_id','!=',9)
            ->where('category_id','!=',10)
            ->first();
        return $prod->category_id;
    }
    public function isFavorite($id)
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
