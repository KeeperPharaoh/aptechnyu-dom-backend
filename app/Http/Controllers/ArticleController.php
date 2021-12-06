<?php

namespace App\Http\Controllers;

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
            $data[$category->title] = $articles;
        }
        return response()->json($data);
    }

    public function articles($id)
    {
        $articles = Article::where('category_id', $id)->get();
        return response()->json($articles);
    }

    public function article($id)
    {
        $article = Article::find($id);
        return response()->json($article);
    }
}
