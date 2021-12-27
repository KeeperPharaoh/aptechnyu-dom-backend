<?php

namespace App\Http\Resources;

use App\Models\Favorite;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

class CategoryProductsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
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


    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            return [
                'id'           => $item->id,
                'title'        => $item->title,
                'subtitle'     => $item->subtitle,
                'image'         => env('APP_URL') . '/storage/' . $item->image,
                'article'      => $item->article,
                'price'        => $item->price,
                'old_price'    => $item->old_price,
                'is_favorite'  => $this->isFavorite($item->id),
            ];
        });
    }
}
