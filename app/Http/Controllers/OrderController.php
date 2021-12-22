<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function create(OrderRequest $request): JsonResponse
    {
        $products     = $request->data;
        $userSetting  = $request->user;
        $status       = ($userSetting['payment_type'] == 1) ? "Оплата при получение" : "Неоплачено";
        $totalSum     = $userSetting['total_sum'];
        $user         = User::query()
                                ->where('id', Auth::id());

        $bonus = $user->select('bonus')->first()->bonus;

        $user->update([
            'bonus' => $bonus + ($totalSum/100) *1.5
            ]);
        try {
            DB::beginTransaction();
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
            DB::commit();

        } catch (\Exception $exception)
        {
            DB::rollBack();

            return response()->json([
                'message'   => 'Произошла ошибка'
                ],409);
        }

        foreach ($products as $product) {
            try {
                DB::beginTransaction();
                Order::query()->create([
                    'cart_id'    => $cart->id,
                    'quantity'   => $product['quantity'],
                    'product' => $product['id']
                ]);
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();

                return response()->json([
                                            'message'   => 'Произошла ошибка'
                                        ],409);
            }
        }
        return response()->json([
            'message' => 'Операция прошла успешно'
            ],200);
    }

    public function history(): JsonResponse
    {
        $carts   = Cart::query()
                      ->where('user_id',Auth::id())
                      ->select('id')
                      ->orderby('created_at', 'desc')
                      ->get()
        ;
        foreach ($carts as $cart) {
            $order = Order::query()
                          ->where('cart_id',$cart->id)
                          ->select('product','quantity')
                          ->first();
            $product = Product::query()
                                ->where('id', $order->product)
                                ->select('id','title','subtitle','article','image','price')
                                ->get();

            $order->product = $product;
            $cart->order       = $order;
//            $cart->order = Order::query()
//                                ->where('cart_id',$cart->id)
//                                ->get();

        }
        return response()->json($carts);
    }
}
