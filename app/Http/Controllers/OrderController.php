<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index ( $request){
    }
    public function accept(OrderRequest $request){
        $carts = session()->get('cart');

        User::where('id',Auth::id())->update([
            'city'      => $request->city,
            'street'    => $request->street,
            'house'     => $request->house,
            'apartment' => $request->apartment,
            'porch'     => $request->porch,
            'floor'     => $request->floor
        ]);
        $cartModel =Cart::create([
            'user_id'   => Auth::id(),
            'sum'       => 123
        ]);

        foreach ($carts as $key => $value){
            Order::create([
                'product_id' => $key,
                'cart_id'    => $cartModel->id,
                'quantity'   => $value
            ]);
        }
        dd(session()->get('cart'));
    }

    public function history(){

    }
}
