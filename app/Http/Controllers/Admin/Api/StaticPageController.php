<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use Illuminate\Http\Request;
use App\Services\RichTextService;

class StaticPageController extends Controller
{
    public function index()
    {
        $pages = StaticPage::all();
        return $pages;
    }

    public function show($id)
    {
        $page = StaticPage::with('seo','content') ->findOrFail($id);
        return $page;
    }

    public function store(Request $request)
    {
        $page = StaticPage::create($request->except('seo','content'));
        $page -> seo() ->create($request -> get('seo'));
        if($request -> get('content')) {
            $richTextService = new RichTextService();
            $text = $richTextService -> store($request->input('content.text'),'static-pages', $page->id);
            $page -> content() -> create(['text' => $text]);
        } else {
            $page -> content() -> create(['text' => '']);
        }

        return'success';
    }

    public function update(Request $request, $id)
    {
        $page = StaticPage::findOrFail($id);
        $page -> update($request -> except('seo', 'content'));
        $seo = $request->get('seo');
        unset($seo['created_at']);
        unset($seo['updated_at']);
        $page ->seo() -> update($seo);
        if($request -> get('content')) {
            $richTextService = new RichTextService();
            $text = $richTextService -> store($request->input('content.text'),'static-pages', $page->id);
            $page -> content() -> update(['text' => $text]);
        } else {
            $page -> content() -> update(['text' => '']);
        }
        return'success';
    }

    public function destroy($id)
    {

    }
}
