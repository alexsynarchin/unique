<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Models\BlockList;
use Illuminate\Http\Request;

class BlockListController extends Controller
{
    public function index(Request $request)
    {
        $block_lists = BlockList::where('type', $request->get('type'))->get();
        return $block_lists;
    }
}
