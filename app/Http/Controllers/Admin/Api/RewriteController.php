<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Rewrite;
use Illuminate\Http\Request;

class RewriteController extends Controller
{
    public function index()
    {
        $rewrites = Rewrite::select('id','created_at', 'email','status', 'name', 'date')->orderBy('created_at', 'desc') ->get();
        return $rewrites;
    }

    public function show($id)
    {
        $rewrite = Rewrite::findOrFail($id);
        $rewrite->status = 1;
        $rewrite->save();
        return $rewrite;
    }

    public function update($id, Request $request)
    {
        $rewrite = Rewrite::findOrFail($id);

        $rewrite->price = $request->get('price');
        $rewrite->status = $request->get('status');
        $rewrite->save();

        return $rewrite;
    }
}
