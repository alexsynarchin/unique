<?php

namespace App\Services\ContentBlock;

use App\Models\ContentBlock;

class GetPageBlocksService
{

    public function index($types)
    {
        $blocks = [];

        foreach ($types as $type) {
            $block = ContentBlock::where('type', $type) -> firstOrFail();
            $blocks[$type] =  $block-> content;
        }

        return $blocks;
    }

    public function lists($types)
    {
        $lists = [];

        foreach ($types as $type) {
            $list = ContentBlock::where('type', $type)  ->orderBy('menuindex','asc')->orderBy('created_at','desc') -> get();
            $list_arr = [];
            foreach ($list as $item) {
                $list_arr[] = $item->content;
            }
            $lists[$type] =  $list_arr;
        }

        return $lists;
    }
}
