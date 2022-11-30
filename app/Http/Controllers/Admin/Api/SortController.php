<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Services\SortService;
use Illuminate\Http\Request;

class SortController extends Controller
{
    public function sort(Request $request)
    {
        $sort = new SortService();
        $return = $sort -> sort($request->get('model'), $request->get('sort'));
        return $return;
    }
}
