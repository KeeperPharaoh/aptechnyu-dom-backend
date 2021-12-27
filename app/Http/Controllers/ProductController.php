<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryProductsCollection;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class ProductController extends BaseController
{
    public function show($id)
    {
        $product = Product::query()
                          ->where('id', $id)
                          ->first()
            ;
        if (!isset($product)) {
            return response()->json([
                'message' => 'Товара не найден'
                ],404);
        }
        return response(
            new ProductResource($product)
        );
    }

    public function analogs($id)
    {
        $analogs = Product::query()
                            ->where('category_id',$id)
                            ->orderByRaw('RAND()')
                            ->take(5)
                            ->get()
        ;


        return response(new CategoryProductsCollection($analogs));
    }

}
