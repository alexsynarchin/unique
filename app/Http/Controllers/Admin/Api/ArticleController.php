<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Services\RichTextService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'DESC')->get();
        return $articles;
    }

    public function show($id)
    {
        $article = Article::with('seo', 'content')->findOrFail($id);
        return $article;
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'Введите название статьи',
        ]);
        $article = Article::create($request->except('seo','content'));
        $article -> seo() ->create($request -> get('seo'));
        if($request->has('imageName')) {
            $article->addMediaFromBase64($request->get('preview'))
                ->toMediaCollection('articles');
        }
        if($request -> get('content')) {
            $richTextService = new RichTextService();
            $text = $richTextService -> store($request->input('content.text'),'articles', $article->id);
            $article -> content() -> create(['text' => $text]);
        } else {
            $article -> content() -> create(['text' => '']);
        }

        return $article;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
        ], [
            'title.required' => 'Введите название статьи',
        ]);

        $article = Article::findOrFail($id);

        $article -> update($request -> except('seo', 'content', 'preview'));
        $seo = $request->get('seo');
        unset($seo['created_at']);
        unset($seo['updated_at']);
        $article -> seo() -> update($seo);
        if($request->has('imageName')) {
            $article->addMediaFromBase64($request->get('preview'))
                ->toMediaCollection('articles');
        }
        if($request -> get('content')) {
            $richTextService = new RichTextService();
            $text = $richTextService -> store($request->input('content.text'),'articles', $article->id);
            $article -> content() -> update(['text' => $text]);
        } else {
            $article -> content() -> update(['text' => '']);
        }

        return $article;
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return $id;
    }
}
