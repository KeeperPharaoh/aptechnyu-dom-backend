<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Http\Resources\CartCollection;
use App\Http\Resources\CategoryProductsCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show(CartRequest $request)
    {
        $cart = $request->all();
        $data = [];
        foreach ($cart as $value){
            $product = Product::find($value['id']);
            if (isset($value['price']) && $product->price != $value['price']){
                return response()->json([
                    'message' => 'Ошибка данные не совпадают'
                ],409);
            }
            $product->quantity = $value['quantity'];
            array_push($data,$product);
        }
        return response()->json(new CartCollection($data));
    }
}

