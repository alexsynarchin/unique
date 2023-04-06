<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Page;
use App\Models\StaticPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class SiteMapController extends Controller
{
    public function index()
    {
        $pages = Page::where('slug', '!=', 'home') -> get();
        $articles = Article::all();
        $static_pages =StaticPage::all();
        $content = View::make('site.base.sitemap') -> with([
            'articles' => $articles,
            'static_pages' => $static_pages,
            'pages' => $pages,
        ]);
        return Response::make($content)->header('Content-Type', 'text/xml');
    }
}
