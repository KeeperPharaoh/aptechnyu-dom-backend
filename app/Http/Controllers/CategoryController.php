<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryProductsCollection;
use App\Models\Category;
use App\Models\CategoryProducts;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function categories()
    {
        $categories = Category::all()->where('show',1);
        return response()->json(new CategoryCollection($categories), 200);

    }

    public function allProducts(){
        $products = Product::paginate(8)->all();
        return response()->json(new CategoryProductsCollection($products));
    }

    public function category(Request $request)
    {
        $category = Category::find($request->id);
        $products = $category->products
            ->where('price',   '>=', $request->min)
            ->where('price',   '<=', $request->max);
        return response()->json([
            'products'    => new CategoryProductsCollection($products),
            'title'       => $category->content_title,
            'description' => $category->description
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->find;
        $products = Product::where('title', 'like', "%{$search}%")
            ->orWhere('subtitle', 'like', "%{$search}%")
            ->orWhere('article', 'like', "%{$search}%")
            ->select('id', 'title', 'subtitle',  'image', 'article', 'price', 'old_price')
            ->paginate(8);

        if ($products->count() > 0){
            return response()->json(new CategoryProductsCollection($products));
        }

        return response()->json('Not Found', 404);
    }
}
