<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Request $request)
    {

        $page = Page::where('slug', $request->get('slug')) -> with('seo')->firstOrFail();

        return $page;
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $page->seo()->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'keywords' => $request->get('keywords'),
        ]);
        return $page;
    }
}
