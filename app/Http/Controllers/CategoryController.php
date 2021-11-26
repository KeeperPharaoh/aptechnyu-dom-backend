<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryProductsCollection;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function allCaregory()
    {
        $categories = Category::all()->where('show',1);
        $data = [];
        foreach ($categories as $category){
            array_push($data, $category['title']);
        }
        return response()->json($data, 200);

    }

    public function caregory($id)
    {
        $category = Category::find($id);
        $products = $category->products()->paginate(8);
        return response()->json([
            'products'    => new CategoryProductsCollection($products),
            'title'       => $category->content_title,
            'description' => $category->description
        ]);
    }

    public function search(Request $request, $search)
    {
        $products = Product::where('title', 'like', "%{$search}%")
            ->orWhere('subtitle', 'like', "%{$search}%")
            ->orWhere('article', 'like', "%{$search}%")
            ->select('id', 'title', 'subtitle',  'image', 'article', 'price', 'old_price')
            ->paginate(8);

        $data = collect($products->toArray())['data'];
        if ($products->count() > 0){
            return response()->json($data);
        }

        return response()->json('Not Found', 404);
    }
}
