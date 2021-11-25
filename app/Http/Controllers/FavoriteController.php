<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function show()
    {
        $favorite = Favorite::where('user_id', Auth::id())->with('products:id,title,subtitle,image,article,price,old_price')->get();

        $data = [];
        foreach ($favorite as $key){
            array_push($data, $key->products);
        }
        return response()->json($data, 200);
    }

    public function favorite(Request $request)
    {
        $favorite = Favorite::
            where('user_id', Auth::id())
            ->where('product_id', $request->product)
            ->first();

        if ($favorite){
            $favorite->delete();
            return response([
                'message' => 'Товар успешно удален'
            ],200);
        }

        Favorite::create([
            'user_id'    => Auth::id(),
            'product_id' => $request->product,
        ]);

        $product = Product::where('id', $request->product)->first();

        return response()->json([
            'message' => 'Товар успешно добавлен'
        ],200);
    }
}
