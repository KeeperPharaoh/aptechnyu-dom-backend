<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Http\Requests\CheckCartRequest;
use App\Http\Resources\CartCollection;
use App\Http\Resources\CategoryProductsCollection;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show(CartRequest $request): JsonResponse
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
            $data[]            = $product;
        }
        return response()->json(new CartCollection($data));
    }

    public function check(CheckCartRequest $request): JsonResponse
    {
        $request   = $request->validated();
        $products  = $request['data'];
        $total_sum = 0;
        foreach ($products as $product) {
            $data = Product::query()->find($product['id']);
            $price = $data->price;
            $total_sum += $price * $product['quantity'];
        }
        if ($request['total_sum'] != $total_sum){
            return response()->json([
                'message' => 'Ошибка корзины'
                ],400);
        }
        return response()->json([
            'message' => 'Операция прошла успешно'
            ],200);
    }
}

