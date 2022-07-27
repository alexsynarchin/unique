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
}
