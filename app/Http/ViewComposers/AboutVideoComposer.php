<?php

namespace App\Http\ViewComposers;


use App\Services\ContentBlock\GetPageBlocksService;
use Illuminate\View\View;

class AboutVideoComposer
{
    public function __construct(GetPageBlocksService $getPageBlocksService)
    {
        $this->getPageBlocksService = $getPageBlocksService;
    }

    public function compose(View $view)
    {
        $types = ['mp-utp'];
        $blocks = $this->getPageBlocksService->index($types);


        return $view->with('blocks', $blocks);

    }
}
