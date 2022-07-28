<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Services\ContentBlock\GetPageBlocksService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $getPageBlocksService;

    public function __construct(GetPageBlocksService $getPageBlocksService)
    {
        $this->getPageBlocksService = $getPageBlocksService;
    }

    public function index()
    {
        $lists= ['reviews-list'];
        $lists = $this->getPageBlocksService->lists($lists);
        return $lists['reviews-list'];
    }
}
