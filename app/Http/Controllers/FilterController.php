<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryProductsCollection;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function price(Request $request)
    {

        $category = Category::find($request->category_id);
        $products = $category->products
            ->where('price',   '>=', $request->min)
            ->where('price',   '<=', $request->max);

        return response(new CategoryProductsCollection($products), 200);

    }
}
