<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Rewrite;
use Illuminate\Http\Request;

class RewriteController extends Controller
{
    public function index()
    {
        $rewrites = Rewrite::orderBy('created_at', 'ASC') ->get();
        return $rewrites;
    }

    public function show($id)
    {
        $rewrite = Rewrite::findOrFail($id);
        return$rewrite;
    }
}
