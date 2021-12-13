<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function allArticles()
    {
        $categories = ArticleCategory::all();
        foreach ($categories as $category){
            $articles = Article::where('category_id', $category->id)->get();
            $data[] = [
                'title'    => $category->title,
                'articles' => new ArticleCollection($articles)
            ];
        }
        return response()->json($data);
    }

    public function articles($id)
    {
        $articles = Article::where('category_id', $id)->get();
        return response()->json(new ArticleCollection($articles));
    }

    public function article($id)
    {
        $article = Article::find($id);
        return response()->json(new ArticleResource($article));
    }
}
