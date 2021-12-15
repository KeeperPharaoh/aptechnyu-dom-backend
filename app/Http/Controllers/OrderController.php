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
    public function create(OrderRequest $request): \Illuminate\Http\JsonResponse
    {
        $products     = $request->data;
        $userSetting  = $request->user;
        $status = ($userSetting['payment_type'] == 1) ? "Оплата при получение" : "Неоплачено";

        $cart = Cart::query()->create([
                'user_id'       => Auth::id(),
                'sum'           => $userSetting['total_sum'],
                'status'        => $status,
                'name'          => $userSetting['name'],
                'phone_number'  => $userSetting['name'],
                'email'         => $userSetting['email']     ?? '',
                'city'          => $userSetting['city'],
                'street'        => $userSetting['street'],
                'house'         => $userSetting['house'],
                'apartment'     => $userSetting['apartment'] ?? '',
                'porch'         => $userSetting['porch']     ?? '',
                'floor'         => $userSetting['floor']     ?? '',
                'comment'       => $userSetting['comment']   ?? ''
                ]);

        foreach ($products as $product) {
            Order::query()->create([
                'cart_id'    => $cart->id,
                'quantity'   => $product['quantity'],
                'product_id' => $product['id']
            ]);
        }
        return response()->json([
            'message' => 'Операция прошла успешно'
            ],200);
    }

    public function history(){
        $cart   = Cart::query()->where('user_id',Auth::id())->get();
        $order  = Order::query()->where('cart_id',$cart->id)->get();
        dd($order);
    }
}
