<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Http\Resources\CartCollection;
use App\Http\Resources\CategoryProductsCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show()
    {
        dd(session()->all());
        $cart = session()->get('cart');
        $data = [];
        if (!$cart){
            return response()->json('Корзина пуста',418);
        }
        foreach ($cart as $key => $value){
            $product = Product::find($key);
            $product->quantity = $value['quantity'];
            array_push($data,$product);
        }

        return response()->json(new CartCollection($data));
    }

    public function add(CartRequest $request)
    {
        $cart = session()->get('cart');

        if (!$cart) {
            $cart[$request->id] = [
                "quantity"  => $request->quantity
            ];
        } else {
            $cart[$request->id] = ['quantity' => $request->quantity];
        }

        session()->put('cart',$cart);

        return response()->json([
            'message' => 'Операция прошла успешно'
        ]);
    }


    public function delete($id)
    {
        $cart = session()->get('cart');
        if (!isset($cart[$id])){
            return response()->json([
                'message' => 'Продукта нету в корзине'
            ],404);
        }
        unset($cart[$id]);
        session()->put('cart',$cart);

        return response()->json([
            'message' => 'Операция прошла успешно'
        ]);
    }
}

