<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show($slug)
    {
        $article = Article::where('slug', $slug) -> with('content', 'seo')->firstOrFail();
        return view('site.articles.show', ['article' => $article]);
    }
}
