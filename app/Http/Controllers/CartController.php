<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Http\Resources\CartCollection;
use App\Http\Resources\CategoryProductsCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show(Request $request)
    {
        $cart = $request->all();
        $data = [];
        foreach ($cart as $value){
            $product = Product::find($value['id']);
            $product->quantity = $value['quantity'];
            array_push($data,$product);
        }
        return response()->json(new CartCollection($data));
    }

    public function add(Request $request)
    {

    }

}

