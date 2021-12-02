<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryProductsCollection;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\CategoryProducts;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function show($id)
    {
        return response(new ProductResource(Product::where('id',$id)->first()));
    }

    public function new()
    {
        $category = Category::where('title','Новые товары')->first();
        $products = $category->products()->get()->sortBy('order')->take(5);
        return response(new CategoryProductsCollection($products));
    }

    public function best()
    {
        $category = Category::where('title','Хиты продаж')->first();
        $products = $category->products()->get()->sortBy('order')->take(5);
        return response(new CategoryProductsCollection($products));
    }
    public function sale()
    {
        $category = Category::where('title','Расспродажа товаров')->first();
        $products = $category->products()->get()->sortBy('order')->take(5);
        return response(new CategoryProductsCollection($products));
    }
}
