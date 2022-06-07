<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Models\BlockList;
use Illuminate\Http\Request;

class BlockListController extends Controller
{
    public function index($type)
    {
        $block_lists = BlockList::where('type', $type)->get();
        return $block_lists;
    }
}
