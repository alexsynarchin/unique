<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\ContentBlock\GetPageBlocksService;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    protected $getPageBlocksService;

    public function __construct(GetPageBlocksService $getPageBlocksService)
    {
        $this->getPageBlocksService = $getPageBlocksService;
    }

    public function show()
    {
        $types = ['about-utp', 'about-guarantees'];
        $lists = ['about-ratings', 'about-guarantees-list'];
        $blocks = $this->getPageBlocksService->index($types);
        $lists = $this->getPageBlocksService->lists($lists);
        return view('site.about.index', ['blocks' => $blocks, 'lists' => $lists]);
    }
}
