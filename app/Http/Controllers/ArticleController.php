<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function categories(): JsonResponse
    {
        $articles = ArticleCategory::all();

        return response()->json($articles);
    }

    public function allArticles(): JsonResponse
    {
        $categories = ArticleCategory::all();
        foreach ($categories as $category) {
            $articles = Article::query()
                               ->where('category_id', $category->id)
                               ->get();
            $data[]   = [
                'title'    => $category->title,
                'articles' => new ArticleCollection($articles),
            ];
        }

        return response()->json($data);
    }

    public function articles($id): JsonResponse
    {
        $articles = Article::query()
                           ->where('category_id', $id)
                           ->get();

        return response()->json(new ArticleCollection($articles));
    }

    public function article($id): JsonResponse
    {
        $article = Article::query()
                          ->find($id);
        if (!isset($article)) {
            return response()->json([
                'message'   =>  'Не найдено'
                                    ],404);
        }
        return response()->json(new ArticleResource($article));
    }
}
