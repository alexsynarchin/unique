<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Models\BlockList;
use Illuminate\Http\Request;

class BlockListController extends Controller
{
    public function index($type)
    {
        $block_lists = BlockList::where('type', $type)

            ->orderBy('created_at','desc')
            ->get();
        return $block_lists;
    }
}
