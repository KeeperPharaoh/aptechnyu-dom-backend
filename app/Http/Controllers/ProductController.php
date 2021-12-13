<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryProductsCollection;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\CategoryProducts;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class ProductController extends BaseController
{
    public function show($id)
    {
        return response(new ProductResource(Product::where('id',$id)->first()));
    }

    public function analogs($id)
    {
        $category = Category::find($id);
        $analogs = $category->products;
        if (count($analogs) > 5){
            $analogs = $analogs->random(5);
        }elseif (isEmpty($analogs)){
            return response()->json([
                'message' => "Товар не найден"
            ],404);
        }


        return response(new CategoryProductsCollection($analogs));
    }

}
