<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryProductsCollection;
use App\Http\Resources\PaginateCollection;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\Promise\all;

class CategoryController extends BaseController
{
    public function categories(): JsonResponse
    {
        $categories = Category::query()
                              ->where('parent_id', null)
                              ->get();

        return response()->json(new CategoryCollection($categories), 200);

    }

    public function showSubCategoriesById($id): JsonResponse
    {
        $subcategories = Category::query()
                                    ->where('parent_id', $id)
                                    ->select('id','title')
                                    ->get();

        return response()->json($subcategories);
    }

    public function showAllProductsByCategory($id): JsonResponse
    {
        $categoryIds = Category::query()
                               ->where('parent_id', $parentId = Category::query()
                                                                        ->where('id', $id)
                                                                        ->value('id'))
                               ->pluck('id')
                               ->push($parentId)
                               ->all();
        $products   = Product::query()
                             ->whereIn('subcategory_id',$categoryIds)
                             ->orderBy('order')
                             ->paginate(15)
        ;

        foreach ($products as $product) {
            $product->image       = env('APP_URL') . '/storage/' . $product->image;
            $product->is_favorite = (bool)$this->isFavorite($product->id);
        }
        return response()->json($products);
    }

    public function allProducts(): JsonResponse
    {
        $products = Product::query()
                           ->select('id', 'title', 'subtitle', 'article', 'image', 'price', 'old_price')
                           ->paginate(15);

        foreach ($products as $product) {
            $product->image       = env('APP_URL') . '/storage/' . $product->image;
            $product->is_favorite = (bool)$this->isFavorite($product->id);
        }

        return response()->json($products);
    }

    public function category(Request $request): JsonResponse
    {
        $id = $request->id;
        $category = Category::query()
                            ->where('id', $id)
                            ->get()
        ;
        if (!isset($request->min)) {
            $request->min = 0;
        }
        if (!isset($request->max)) {
            $request->max = 999999;
        }
        $products = Product::query()
                             ->where('subcategory_id', $id)
                             ->where('products.price', '>=', $request->min)
                             ->where('products.price', '<=', $request->max)
                             ->orderBy('order')
                             ->paginate(15)
                             ;

        foreach ($products as $product) {
            $product->image       = env('APP_URL') . '/storage/' . $product->image;
            $product->is_favorite = (bool)$this->isFavorite($product->id);
            $products->makeHidden(['instruction', 'description', 'manufacturer', 'composition', 'stock', 'country']);
        }
        return response()->json([
                                    'products'    => $products,
                                ]);
    }

    public function search(Request $request): JsonResponse
    {
        $search   = $request->find;
        $products = Product::where('title', 'like', "%{$search}%")
                           ->orWhere('subtitle', 'like', "%{$search}%")
                           ->orWhere('article', 'like', "%{$search}%")
                           ->select('id', 'title', 'subtitle', 'image', 'article', 'price', 'old_price')
                           ->paginate(8);
        foreach ($products as $product) {
            $product->image       = env('APP_URL') . '/storage/' . $product->image;
            $product->is_favorite = (bool)$this->isFavorite($product->id);
        }
        if ($products->count() > 0) {
            return response()->json($products);
        }

        return response()->json('Not Found', 404);
    }

    public function new(): JsonResponse
    {
        $products = Product::query()
                            ->where('new', true)
                            ->get()
                            ;
        foreach ($products as $product) {
            $product->image       = env('APP_URL') . '/storage/' . $product->image;
            $product->is_favorite = (bool)$this->isFavorite($product->id);
            $products->makeHidden(['instruction', 'description', 'manufacturer', 'composition', 'stock', 'country']);
        }
        return response()->json($products);
    }

    public function best(): JsonResponse
    {
        $products = Product::query()
                           ->where('hits', true)
                           ->get()
        ;
        foreach ($products as $product) {
            $product->image       = env('APP_URL') . '/storage/' . $product->image;
            $product->is_favorite = (bool)$this->isFavorite($product->id);
            $products->makeHidden(['instruction', 'description', 'manufacturer', 'composition', 'stock', 'country']);
        }
        return response()->json($products);
    }

    public function sale(): JsonResponse
    {
        $products = Product::query()
                           ->where('sale', true)
                           ->get()
        ;
        foreach ($products as $product) {
            $product->image       = env('APP_URL') . '/storage/' . $product->image;
            $product->is_favorite = (bool)$this->isFavorite($product->id);
            $products->makeHidden(['instruction', 'description', 'manufacturer', 'composition', 'stock', 'country']);
        }
        return response()->json($products);
    }

    private function isFavorite($id): int
    {
        if (Auth::guard('sanctum')
                ->check()) {
            $status = Favorite::query()
                              ->where('product_id', $id)
                              ->where('user_id', Auth::guard('sanctum')->id())
                              ->first();

            return !empty($status);
        }

        return false;
    }

}
