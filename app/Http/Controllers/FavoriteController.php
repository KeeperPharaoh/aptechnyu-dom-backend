<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isEmpty;

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

    public function add(Request $request)
    {
        $favorite = Favorite::
        where('user_id', Auth::id())
            ->where('product_id', $request->product)
            ->first();

        if ($favorite){
            return response([
                'message' => 'Товар уже в корзине'
            ],422);
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

    public function delete(Request $request)
    {

        $favorite = Favorite::
        where('user_id', Auth::id())
            ->where('product_id', $request->product)
            ->first();
        if (!isset($favorite)){
            return response([
                'message' => 'Товара нету в корзине',
            ],422);
        }
        $favorite->delete();
        return response([
            'message' => 'Товар успешно удален'
        ],200);
    }
}
