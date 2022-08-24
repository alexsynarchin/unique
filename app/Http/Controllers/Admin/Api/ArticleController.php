<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created', 'DESC')->get();
        return $articles;
    }

    public function store()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
