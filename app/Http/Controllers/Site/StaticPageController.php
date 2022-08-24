<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function show($slug)
    {

        $page = StaticPage::with('content','seo') -> where('slug', $slug)->firstOrFail();
        $seo = $page->seo;
        $content = $page->content -> text;
        return view('site.static-page.show',[
            'page' => $page,
            'content' => $content,
            'seo' => $seo,
        ]);
    }
}
