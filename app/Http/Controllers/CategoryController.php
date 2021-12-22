<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryProductsCollection;
use App\Http\Resources\PaginateCollection;
use App\Models\Category;
use App\Models\CategoryProducts;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Promise\all;

class CategoryController extends BaseController
{
    public function categories(): \Illuminate\Http\JsonResponse
    {
        $categories = Category::query()
                              ->where('show',1)
                              ->get();
        return response()->json(new CategoryCollection($categories), 200);

    }

    public function allProducts(): \Illuminate\Http\JsonResponse
    {
        $products = Product::query()
            ->select('id','title','subtitle','article','image','price','old_price')
            ->paginate(15);
        foreach ($products as $product) {
            $product->image       = env('APP_URL') . '/storage/' . $product->image;
            $product->is_favorite = (bool) $this->isFavorite($product->id);
        }
        return response()->json($products);
    }

    public function category(Request $request): \Illuminate\Http\JsonResponse
    {
        $category = Category::find($request->id);
        if (!isset($request->min)) {
            $request->min = 0;
        }
        if (!isset($request->max)) {
            $request->max = 999999;
        }
        $products = $category->Products()
                ->where('products.price',   '>=', $request->min)
                ->where('products.price',   '<=', $request->max)
                ->paginate(15);
        foreach ($products as $product) {
            $product->image       = env('APP_URL') . '/storage/' . $product->image;
            $product->is_favorite = (bool) $this->isFavorite($product->id);
            $products->makeHidden(['instruction','description','manufacturer','composition','stock','country']);
        }
        return response()->json([
            'products'    => $products,
            'title'       => $category->content_title,
            'description' => $category->description
        ]);
    }

    public function search(Request $request): \Illuminate\Http\JsonResponse
    {
        $search = $request->find;
        $products = Product::where('title', 'like', "%{$search}%")
            ->orWhere('subtitle', 'like', "%{$search}%")
            ->orWhere('article', 'like', "%{$search}%")
            ->select('id', 'title', 'subtitle',  'image', 'article', 'price', 'old_price')
            ->paginate(8);
        foreach ($products as $product) {
            $product->image       = env('APP_URL') . '/storage/' . $product->image;
            $product->is_favorite = (bool) $this->isFavorite($product->id);
        }
        if ($products->count() > 0){
            return response()->json($products);
        }

        return response()->json('Not Found', 404);
    }

    public function new()
    {
        $category = Category::where('title','Новые товары')->first();
        $products = $category->products()->get()->take(5);
        foreach ($products as $product) {
            $product->image       = env('APP_URL') . '/storage/' . $product->image;
            $product->is_favorite = (bool) $this->isFavorite($product->id);
            $products->makeHidden(['instruction','description','manufacturer','composition','stock','country']);
        }
        return response()->json($products);
    }

    public function best()
    {
        $category = Category::where('title','Хиты продаж')->first();
        $products = $category->products()->get()->take(5);

        foreach ($products as $product) {
            $product->image       = env('APP_URL') . '/storage/' . $product->image;
            $product->is_favorite = (bool) $this->isFavorite($product->id);
            $products->makeHidden(['instruction','description','manufacturer','composition','stock','country']);
        }
        return response()->json($products);
    }
    public function sale()
    {
        $category = Category::where('title','Расспродажа товаров')->first();
        $products = $category->products()->get()->take(5);
        foreach ($products as $product) {
            $product->image       = env('APP_URL') . '/storage/' . $product->image;
            $product->is_favorite = (bool) $this->isFavorite($product->id);
            $products->makeHidden(['instruction','description','manufacturer','composition','stock','country']);
        }
        return response()->json($products);
    }

    private function isFavorite($id) : int
    {
        if (Auth::guard('sanctum')->check()){
            $status = Favorite::query()
                ->where('product_id', $id)
                ->where('user_id',Auth::guard('sanctum')->id())
                ->first();
            return !empty($status);
        }
        return false;
    }
}
