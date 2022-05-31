<?php

namespace App\Http\Controllers\Admin\Api;

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

    public function store(Request $request)
    {

        $block_list = BlockList::create($request->all());
        return $block_list;
    }

    public function destroy($id)
    {
        $block_list = BlockList::findOrFail($id);
        $block_list -> delete();
        return $id;
    }
}
