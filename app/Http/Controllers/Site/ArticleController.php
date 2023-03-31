<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Page;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function show($slug)
    {
        $article = Article::where('slug', $slug) -> with('content', 'seo')->firstOrFail();
        $interestingArticles = Article::where('id', '!=', $article->id)
            ->where('published', 1)
            ->orderBy('created_at','desc')
            ->limit(3)
            ->get();
        $page = Page::where('slug', 'articles')->firstOrFail();
        $seo = $page->seo;
        return view('site.articles.show', ['article' => $article, 'interesting_articles' => $interestingArticles, 'seo'=>$seo]);
    }
}
